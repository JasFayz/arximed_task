<?php

namespace App\Enums;

enum TaskStatus: int
{
    case PENDING = 0;

    case DONE = 1;


    public static function statusText($status)
    {
        return match ($status) {
            self::PENDING->value => 'В процессе',
            self::DONE->value => 'Отредактировано администратором',
            'default' => new \InvalidArgumentException()
        };
    }
}
