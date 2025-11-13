<?php

namespace App\Http\Enum;

enum ViewTypeEnum: int
{
    case Dashboard = 1;
    case Website = 2;


    public function label(): string
    {
        return match ($this) {
            self::Dashboard => 'لوحة التحكم',
            self::Website => 'الموقع الالكتروني',
        };
    }
}
