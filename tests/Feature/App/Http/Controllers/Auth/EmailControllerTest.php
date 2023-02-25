<?php
declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\EmailController;
use Domains\Shared\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

final class EmailControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->createOne([
            'email_verified_at' => null
        ]);
    }

    public function test_the_verify_page_open_success()
    {
        $response = $this
            ->actingAs($this->user)
            ->get(action([EmailController::class, 'verify']));

        $response
            ->assertOk()
            ->assertSee('Подтверждение почты')
            ->assertViewIs('domains.auth.email.verify');
    }

    public function test_the_verify_page_open_failed_for_unauthorized_user()
    {
        $response = $this
            ->get(action([EmailController::class, 'verify']));

        $response
            ->assertRedirectToRoute('login');
    }

    public function test_the_verify_handler_work_success()
    {
        $this->assertNotTrue($this->user->hasVerifiedEmail());

        $verificationUrl = (new VerifyEmail())->toMail($this->user)->actionUrl;

        $response = $this
            ->actingAs($this->user)
            ->get($verificationUrl);

        $this->assertTrue($this->user->hasVerifiedEmail());

        $response->assertRedirectToRoute('home');
    }

    public function test_the_verify_handler_work_failed_for_another_user()
    {
        /** @var User $newUser */
        $newUser = User::factory()->createOne([
            'email_verified_at' => null
        ]);

        $this->assertNotTrue($newUser->hasVerifiedEmail());

        $verificationUrl = (new VerifyEmail())->toMail($this->user)->actionUrl;

        $response = $this
            ->actingAs($newUser)
            ->get($verificationUrl);

        $this->assertFalse($newUser->hasVerifiedEmail());

        $response->assertStatus(403);
    }

    public function test_the_send_verification_to_user_success()
    {
        $response = $this
            ->actingAs($this->user)
            ->post(action([EmailController::class, 'sendVerificationPost']));

        Notification::assertSentTo($this->user, VerifyEmail::class);

        $response->assertRedirectToRoute('home');
    }

    public function test_the_send_verification_to_user_failed_for_unauthorized_user()
    {
        $response = $this
            ->post(action([EmailController::class, 'sendVerificationPost']));

        $response
            ->assertRedirectToRoute('login');
    }
}
