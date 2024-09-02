<?php

namespace App\Enums;

enum BlogStatus: int
{
    const DRAFT = 1;
    const RELEASED = 2;
    const CLOSED = 3;
    const DELETED = 10;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::DRAFT:
                return '下書き';
            case self::RELEASED:
                return '公開';
            case self::CLOSED:
                return '非公開';
            case self::DELETED:
                return '削除';
            default:
                return self::getKey($value);
        }
    }

    public static function getAll(): Array
    {
        return [
            self::DRAFT => '下書き',
            self::RELEASED => '公開',
            self::CLOSED => '非公開',
            self::DELETED => '削除',
        ];
    }
}