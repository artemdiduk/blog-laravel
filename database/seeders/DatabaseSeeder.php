<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Group;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)->create();
        Group::factory(3)->create();
        Post::factory(3)->create();
        if (!($role = Role::where("name", 'admin')->first())) {
            Role::create(['name' => "admin", 'slag' => 'admin']);
            User::create(['name' => "admin", 'slag' => "admin", 'email' => 'admin@mail.com', 'password' => Hash::make(123456)]);
            $user = User::where("name", 'admin')->first();
            $user->roles()->attach($role);
        }
    }
}
