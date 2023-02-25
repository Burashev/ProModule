<?php
declare(strict_types=1);

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\AuthController;
use Domains\Shared\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

final class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private array $loginData;
    private array $registerData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->createOne([
            'email' => 'email@ya.ru'
        ]);

        $this->loginData = [
            'email' => 'email@ya.ru',
            'password' => 'password'
        ];

        $this->registerData = [
            'email' => 'email2@ya.ru',
            'name' => 'Alexander',
            'sex' => 'Мужской',
            'city' => 'Казань',
            'institution' => 'МЦК-КТИСТ',
            'institution_type' => 'СПО',
            'password' => '12341234',
            'password_confirmation' => '12341234',
            'role_id' => 1
        ];
    }

    protected function loginRequest(): TestResponse
    {
        return $this->post(action([AuthController::class, 'loginPost']), $this->loginData);
    }

    protected function registerRequest(): TestResponse
    {
        return $this->post(action([AuthController::class, 'registerPost']), $this->registerData);
    }

    public function test_the_login_page_open_success()
    {
        $response = $this->get(action([AuthController::class, 'login']));
        $response
            ->assertOk()
            ->assertSee('Авторизация')
            ->assertViewIs('domains.auth.login');
    }

    public function test_the_login_validation_success()
    {
        $this->loginRequest()->assertValid();
    }

    public function test_the_login_password_validation_failed()
    {
        $this->loginData['password'] = '1234';

        $this->loginRequest()->assertInvalid(['password']);
    }

    public function test_the_login_email_validation_failed()
    {
        $this->loginData['email'] = 'incorrect';

        $this->loginRequest()->assertInvalid(['email']);
    }

    public function test_the_login_successful()
    {
        $this->loginRequest();

        $this->assertAuthenticatedAs($this->user);
    }

    public function test_the_login_failed()
    {
        $this->loginData['password'] = '12344321';
        $response = $this->loginRequest();

        $response->assertSessionHasErrors(['email']);
    }

    public function test_the_redirect_after_login_success()
    {
        $this->loginRequest()->assertRedirectToRoute('home');
    }

    public function test_the_register_page_open_success()
    {
        $response = $this->get(action([AuthController::class, 'register']));
        $response
            ->assertOk()
            ->assertSee('Регистрация')
            ->assertViewIs('domains.auth.register');
    }

    public function test_the_register_validation_success()
    {
        $response = $this->registerRequest();

        $response
            ->assertValid();
    }

    public function test_the_register_email_validation_failed()
    {
        $this->registerData['email'] = 'incorrect';

        $response = $this->registerRequest();

        $response
            ->assertInvalid(['email']);
    }

    public function test_the_register_password_validation_failed()
    {
        $this->registerData['password'] = 'incorrect';

        $response = $this->registerRequest();

        $response
            ->assertInvalid(['password']);
    }

    public function test_the_register_role_validation_failed()
    {
        $this->registerData['role_id'] = 33;

        $response = $this->registerRequest();

        $response
            ->assertInvalid(['role_id']);
    }

    public function test_the_register_create_user_success()
    {
        $this->assertDatabaseMissing('users', ['email' => $this->registerData['email']]);

        $this->registerRequest();

        $this->assertDatabaseHas('users', ['email' => $this->registerData['email']]);

        $user = User::query()->firstWhere('email', $this->registerData['email']);

        $this->assertDatabaseHas('user_bio', ['user_id' => $user->getKey()]);
    }

    public function test_the_register_event_dispatched_success()
    {
        Event::fake();
        $this->registerRequest();
        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailVerificationNotification::class);
    }

    public function test_the_register_notification_send_success()
    {
        $this->registerRequest();

        $user = User::query()->firstWhere('email', $this->registerData['email']);

        Notification::assertSentTo($user, VerifyEmail::class);
    }

}
