<?php

namespace App\Enums;

enum GameDuration: int
{
    case ONESHOT = 0;
    case CAMPAIGN = 1;
    case ANY = 2;

    public function label(): string
    {
        return match($this) {
            self::ONESHOT => 'Ваншот (Одна игра)',
            self::CAMPAIGN => 'Кампания (Больше одной игры)',
            self::ANY => 'Ваншот (Одна игра) с возможностью перейти в кампанию',
        };
    }
}
