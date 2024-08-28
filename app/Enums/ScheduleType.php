<?php

namespace App\Enums;

enum ScheduleType: int
{
    const TOTO = 1;
    const MINI_A = 2;
    const MINI_B = 3;
    const GOAL3 = 4;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::TOTO:
                return 'toto';
            case self::MINI_A:
                return 'mini toto A組';
            case self::MINI_B:
                return 'mini toto B組';
            case self::GOAL3:
                return 'totoGOAL3';
            default:
                return self::getKey($value);
        }
    }

    public static function getAll(): Array
    {
        return [
            self::TOTO => 'toto',
            self::MINI_A => 'mini toto A組',
            self::MINI_B => 'mini toto B組',
            self::GOAL3 => 'totoGOAL3',
        ];
    }
}