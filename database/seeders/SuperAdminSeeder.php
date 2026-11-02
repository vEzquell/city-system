<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class SuperAdminSeeder extends Seeder
{
    
    public function run(): void
    {
        $username = 'superadmin';

        $password = env('SUPER_ADMIN_PASSWORD');

        if (! $password || strlen($password) < 8 ) {
            throw new RuntimeException(
                'Set a secure password for the super admin in the .env file using the key "SUPER_ADMIN_PASSWORD" (minimum 8 characters).'
            );
        }

        $user = User::firstOrNew([
            'username' => $username
        ]);

        if ($user->exists) {
            $this->command->info(
                'Super Admin already exists'
            );

            return;
        }

        $user->name = 'System Administrator';
        $user->password = Hash::make($password);
        $user->role = 'super_admin';
        $user->status = 'active';

        $user->save();

        $this->command->info(
            'Super Admin created successfully'
        );
    }
}
