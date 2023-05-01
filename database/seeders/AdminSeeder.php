<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Role::where("name", 'admin')->first()) {
            $role =  Role::create(['name' => "admin", 'slag' => 'admin']);
            $user = User::create(['name' => "admin", 'slag' => "admin", 'email' => 'admin@mail.com', 'password' => Hash::make(123456)]);
            $user->roles()->attach($role);
        }
    }
}
