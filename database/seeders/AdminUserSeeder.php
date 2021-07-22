<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $role = Role::query()
        ->where('name',UserRole::admin)
        ->first();

        $user = new User();
        $user->fill([
            'name' => 'Администратор',
            'email' => 'admin@admin.com',
            'password' => \Hash::make('password'),
        ]);

        $user->forceFill([
            'email_verified_at' => now()
        ]);
        $user->role()->associate($role);
        $user->save();
    }
}
