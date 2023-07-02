<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'achraf nachchache',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
        User::create([
            'name' => 'achraf no',
            'email' => 'user@users.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);
    }
}
