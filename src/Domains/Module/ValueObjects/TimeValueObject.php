<?php
declare(strict_types=1);

namespace Domains\Module\ValueObjects;

use http\Exception\InvalidArgumentException;

final class TimeValueObject implements \Stringable
{
    public function __construct(
        private int $value,
    )
    {
        if ($this->value < 0) {
            throw new InvalidArgumentException('Value can not be lower than zero');
        }
    }

    public function getRawValue(): int
    {
        return $this->value;
    }

    public function getHours(): int {
        return intdiv($this->value, 60);
    }

    public function getMinutes(): int {
        return $this->value % 60;
    }

    public function getFormatValue(): string
    {
        $hours = $this->getHours();

        $hoursString = match (true) {
            $hours === 1 => '1 Час',
            $hours === 0 => '0 Часов',
            $hours < 5 => "$hours Часа",
            default => "$hours Часов"
        };

        $minutes = $this->getMinutes();
        $minuteLastNum = $minutes % 10;

        $minutesString = match (true) {
            $minutes >= 10 && $minutes <= 19 => "{$minutes} Минут",
            $minuteLastNum === 0 || ($minuteLastNum >= 5 && $minuteLastNum <= 9) => "{$minutes} Минут",
            $minuteLastNum === 1 => "1 Минута",
            $minuteLastNum >= 2 && $minuteLastNum <= 4 => "{$minutes} Минуты"
        };

        return "$hoursString $minutesString";
    }

    public function __toString(): string
    {
        return $this->getFormatValue();
    }
}
