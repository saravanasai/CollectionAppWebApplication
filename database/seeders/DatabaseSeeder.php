<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"Super Admin",
            "phonenumber"=>"7708454539",
            "email"=>"admin@exciteon.com",
            "password"=>Hash::make('1234'),
            "is_admin"=>1,
        ]);

        $this->call(LocationSeeder::class);
        $this->call(AgentSeeder::class);

        $this->call(PlanSeeder::class);
        $this->call(SchemeSeeder::class);
        // $this->call(CustomerSeeder::class);
    }
}
