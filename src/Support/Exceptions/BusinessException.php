<?php
declare(strict_types=1);

namespace Support\Exceptions;

final class BusinessException extends \RuntimeException
{
    private string $userMessage;

    public function __construct(string $message = "")
    {
        $this->userMessage = $message;
        parent::__construct("Business exception");
    }

    /**
     * @return string
     */
    public function getUserMessage(): string
    {
        return $this->userMessage;
    }
}
