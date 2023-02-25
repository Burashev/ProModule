<?php
declare(strict_types=1);

namespace Domains\Auth\DTOs;

use Illuminate\Http\Request;

final readonly class NewUserBioDTO
{
    public function __construct(
        public string $name,
        public string $sex,
        public string $city,
        public string $institution,
        public string $institution_type,
    )
    {
    }

    public static function fromRequest(Request $request): self
    {
        return new self(...$request->only(
            'name',
            'sex',
            'city',
            'institution',
            'institution_type'
        ));
    }
}
