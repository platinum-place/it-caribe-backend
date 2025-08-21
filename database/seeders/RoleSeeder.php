<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as SpatieRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guards = config('auth.guards');

        foreach (RoleEnum::cases() as $role) {
            foreach ($guards as $key => $guard) {
                app(SpatieRole::class)->findOrCreate($role->value, $key);
            }
        }
    }
}
