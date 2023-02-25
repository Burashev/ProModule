<?php
declare(strict_types=1);

namespace Domains\Auth\DTOs;

use Illuminate\Http\Request;

final readonly class NewUserDTO
{
    public function __construct(
        public string     $email,
        public string     $password,
        public string|int $role_id,
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(...$request->only('email', 'role_id', 'password'));
    }
}
