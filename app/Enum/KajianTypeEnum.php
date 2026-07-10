<?php

namespace App\Enum;

enum KajianTypeEnum: string
{
    case ONLINE = 'online';
    case OFFLINE = 'offline';
    case YOUTUBE = 'youtube';

    public function getLabel(): string
    {
        return match($this) {
            self::ONLINE => 'Online',
            self::OFFLINE => 'Offline',
            self::YOUTUBE => 'Youtube',
        };
    }

    public static function options()
    {
        return collect(self::cases())->mapWithKeys(fn ($case) =>[
            $case->value => $case->getLabel(),
        ]);
    }
}
