<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::create([
            'nama'          => $faker->name,
            'id_card'       => 'K'.$faker->unique()->randomNumber(5, true),
            'role'          => 'admin',
            'password'      => Hash::make('katsuyama2024'),
        ]);
        User::create([
            'nama'          => $faker->name,
            'id_card'       => 'admin',
            'role'          => 'admin',
            'password'      => Hash::make('katsuyama2024'),
        ]);
    }
}
