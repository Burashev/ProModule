<?php
declare(strict_types=1);

namespace Domains\Auth\Actions;

use Domains\Shared\Models\User;

final class SendEmailVerificationToUserAction
{
    public function __invoke(User $user): void
    {
        $user->sendEmailVerificationNotification();
    }
}
