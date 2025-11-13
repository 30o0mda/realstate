<?php

namespace App\Http\Enum\User;

enum UserTypeEnum: int
{
    case Client = 1;
    case Broker = 2;


    public function label(): string
    {
        return match ($this) {
            self::Client => 'عميل',
            self::Broker => 'وسيط',
        };
    }
}
