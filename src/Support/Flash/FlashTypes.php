<?php
declare(strict_types=1);

namespace Support\Flash;

enum FlashTypes: string
{
    case Info = 'info';
    case Error = 'error';
}
