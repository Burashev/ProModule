<?php
declare(strict_types=1);

namespace Domains\Shared\Enums;

enum RolesEnum: int
{
    case COMPETITOR_ID = 1;
    case EXPERT_ID = 2;
    case ADMINISTRATOR_ID = 3;
}
