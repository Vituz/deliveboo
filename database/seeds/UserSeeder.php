<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++){
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->address = $faker->address();
            $newUser->city = $faker->city();
            $newUser->p_iva = $faker->numerify('###########');
            $newUser->image = $faker->imageUrl(640, 480);
            $newUser->email = $faker->freeEmail();
            $newUser->password = Hash::make('password');
            $newUser->save();

        }
    }
}

