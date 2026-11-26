<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find or create the admin account
        $admin = User::firstOrNew([
            'email' => 'admin@example.com',
        ]);

        $admin->name = 'Admin';
        $admin->password = Hash::make('Admin@123');
        $admin->role = 'admin';

        $admin->save();
    }
}
