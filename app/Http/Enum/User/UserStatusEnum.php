<?php

namespace App\Http\Enum\User;

enum UserStatusEnum: int
{
    case Pending = 0;
    case Accepted = 1;
    case Rejected = 2;

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'معلق',
            self::Accepted => 'مقبول',
            self::Rejected => 'مرفوض',
        };
    }
}
