<?php

namespace App\Enums;

enum Category: int
{
    const J1 = 1;
    const J2 = 2;
    const J3 = 3;
    const OTHER = 4;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::J1:
                return 'J1';
            case self::J2:
                return 'J2';
            case self::J3:
                return 'J3';
            case self::OTHER:
                return 'その他';
            default:
                return self::getKey($value);
        }
    }

    public static function getAll(): Array
    {
        return [
            self::J1 => 'J1',
            self::J2 => 'J2',
            self::J3 => 'J3',
            self::OTHER => 'その他',
        ];
    }
}