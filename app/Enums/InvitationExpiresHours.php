<?php

namespace App\Enums;

enum InvitationExpiresHours: string
{
    case H12 = '12';
    case H24 = '24';
    case H48 = '48';
    case H72 = '72';

    public function label(): string
    {
        return match ($this) {
            self::H12 => '12 h',
            self::H24 => '24 h',
            self::H48 => '48 h',
            self::H72 => '72 h',
        };
    }

    public function toInt(): int
    {
        return (int) $this->value;
    }

    public static function default(): self
    {
        return self::H48;
    }
}
