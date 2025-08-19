<?php

namespace Database\Seeders;

use App\Enums\Role;
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

        foreach (Role::cases() as $role) {
            foreach ($guards as $key => $guard) {
                app(SpatieRole::class)->findOrCreate($role->value, $key);
            }
        }
    }
}
