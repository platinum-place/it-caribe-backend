<?php

namespace Database\Seeders;

use App\forlder\Action;
use App\forlder\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guards = config('auth.guards');

        foreach (Model::cases() as $model) {
            foreach (Action::cases() as $action) {
                foreach ($guards as $key => $guard) {
                    app(Permission::class)->findOrCreate(combine_permissions($model, $action));
                }
            }
        }
    }
}
