<?php

namespace Database\Seeders;

use App\Enums\ClinicRole;
use App\Models\Clinic;
use App\Models\ClinicMembership;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClinicSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (! $user) {
            return;
        }

        $clinic = Clinic::firstOrCreate(
            ['slug' => 'demo-clinic'],
            [
                'name' => 'Demo Clinic',
                'slug' => 'demo-clinic',
            ]
        );

        ClinicMembership::firstOrCreate(
            [
                'clinic_id' => $clinic->id,
                'user_id' => $user->id,
            ],
            [
                'role' => ClinicRole::Owner,
            ]
        );
    }
}
