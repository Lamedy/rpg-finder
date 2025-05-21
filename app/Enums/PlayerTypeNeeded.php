<?php

namespace App\Enums;

enum PlayerTypeNeeded: int
{
    case PLAYER = 0;
    case MASTER = 1;

    public function label(): string
    {
        return match($this) {
            self::PLAYER => 'Игроки',
            self::MASTER => 'Мастер',
        };
    }
}
