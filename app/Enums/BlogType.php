<?php

namespace App\Enums;

enum BlogType: int
{
    const PREDICTION = 1;
    const ACHIEVEMENT = 2;
    const REVIEW = 3;
    const OTHER = 10;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::PREDICTION:
                return '予想';
            case self::ACHIEVEMENT:
                return '的中';
            case self::REVIEW:
                return '振り返り';
            case self::OTHER:
                return 'その他';
            default:
                return self::getKey($value);
        }
    }

    public static function getAll(): Array
    {
        return [
            self::PREDICTION => '予想',
            self::ACHIEVEMENT => '的中',
            self::REVIEW => '振り返り',
            self::OTHER => 'その他',
        ];
    }
}