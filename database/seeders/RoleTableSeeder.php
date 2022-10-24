<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'slug' => 'administrator',
            'description' => 'This role can do anything.'
        ]);

        Role::create([
            'name' => 'Buyer',
            'slug' => 'buyer',
            'description' => 'This role only can do buying.'
        ]);
    }
}
