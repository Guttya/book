<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\City;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use \Faker\Generator;

class UserSeeder extends Seeder
{
    public function run(Generator $faker)
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $userInfo = new UserInfo([
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'city_id' => City::first()->id,
            'library_card' => $faker->numberBetween(10000, 99000),
        ]);

        $user->userInfo()->save($userInfo);
    }
}
