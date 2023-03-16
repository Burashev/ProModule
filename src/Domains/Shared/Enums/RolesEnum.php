<?php
declare(strict_types=1);

namespace Domains\Shared\Enums;

enum RolesEnum: int
{
    case COMPETITOR_ID = 1;
    case EXPERT_ID = 2;
    case ADMINISTRATOR_ID = 3;

    public function isCompetitor(): bool {
        return $this === RolesEnum::COMPETITOR_ID;
    }

    public function isExpert(): bool {
        return $this === RolesEnum::EXPERT_ID;
    }

    public function isAdministrator(): bool {
        return $this === RolesEnum::ADMINISTRATOR_ID;
    }
}
