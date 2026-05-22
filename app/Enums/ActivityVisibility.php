<?php /** @noinspection PhpUnused */

namespace App\Enums;

enum ActivityVisibility: string
{
    case Operational = 'operational';
    case Clinical = 'clinical';
    case Private = 'private';
    case System = 'system';

    public function isOperational(): bool
    {
        return $this === self::Operational;
    }

    public function isClinical(): bool
    {
        return $this === self::Clinical;
    }

    public function isPrivate(): bool
    {
        return $this === self::Private;
    }

    public function isSystem(): bool
    {
        return $this === self::System;
    }
}
