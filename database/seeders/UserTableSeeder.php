<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('slug', 'administrator')->first();
        User::factory()->create([
            'name' => 'Administrator',
            'username' => 'administrator',
            'email' => 'test@example.com',
            'password' => bcrypt('#Admin123'),
            'role_id' => $role->id,
        ]);
    }
}
