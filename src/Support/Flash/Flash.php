<?php
declare(strict_types=1);

namespace Support\Flash;

use Illuminate\Contracts\Session\Session;

final class Flash
{
    private const MESSAGE_KEY = 'promodule_flash_message';
    private const MESSAGE_TYPE = 'promodule_flash_type';

    public function __construct(private readonly Session $session)
    {

    }

    public function get(): ?FlashMessage
    {
        if (!$this->session->has(self::MESSAGE_KEY)) {
            return null;
        }

        $message = $this->session->get(self::MESSAGE_KEY);

        return new FlashMessage($message, $this->session->get(self::MESSAGE_TYPE));
    }

    public function info(string $message): void {
        $this->createFlash($message, FlashTypes::Info);
    }

    public function error(string $message): void {
        $this->createFlash($message, FlashTypes::Error);
    }

    private function createFlash(string $message, FlashTypes $type): void {
        $this->session->flash(self::MESSAGE_KEY, $message);
        $this->session->flash(self::MESSAGE_TYPE, $type->value);
    }
}
