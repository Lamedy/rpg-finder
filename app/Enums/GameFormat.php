<?php

namespace App\Enums;

enum GameFormat: int
{
    case LIVE = 0;
    case ONLINE = 1;
    case ANY = 2;

    public function label(): string
    {
        return match($this) {
            self::LIVE => 'Вживую',
            self::ONLINE => 'Онлайн',
            self::ANY => 'Любой',
        };
    }
}
