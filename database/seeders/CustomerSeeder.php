<?php

namespace Database\Seeders;

use App\Models\Collection\Collection;
use App\Models\Customer\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->count(50)->create()->each(function ($user) {

            $user->Collection()->save(Collection::factory()->make());
        });
    }
}
