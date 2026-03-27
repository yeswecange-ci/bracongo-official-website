<?php

namespace App\Enums;

enum UserStatus: string
{
    case Invited = 'invited';
    case Active = 'active';
    case Disabled = 'disabled';

    public function label(): string
    {
        return match ($this) {
            self::Invited => 'Invité',
            self::Active => 'Actif',
            self::Disabled => 'Désactivé',
        };
    }
}
