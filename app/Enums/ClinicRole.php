<?php /** @noinspection PhpUnused */

namespace App\Enums;

enum ClinicRole: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Doctor = 'doctor';
    case Assistant = 'assistant';
}
