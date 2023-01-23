<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => "admin", 'slag' => "admin", 'email' => 'admin@mail.com', 'password' => Hash::make(123456)]);
        Role::create(['name' => "admin", 'slag' => "Админ"]);
      
       
    }
}
