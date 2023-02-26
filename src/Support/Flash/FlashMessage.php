<?php
declare(strict_types=1);

namespace Support\Flash;

final readonly class FlashMessage
{
    public function __construct(private string $message, private string $type)
    {

    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
