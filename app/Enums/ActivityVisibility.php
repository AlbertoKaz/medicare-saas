<?php

namespace App\Enums;

enum ActivityVisibility: string
{
    case Operational = 'operational';
    case Clinical = 'clinical';
    case Private = 'private';
    case System = 'system';
}
