<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

use App\User;

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
            $newUser->name = $faker->name;
            $newUser->address = $faker->address;
            $newUser->p_iva = $faker->cpf(false);
            $newUser->image = $faker->imageUrl(640, 480);
            $newUser->email = $faker->freeEmail;
            $newUser->password = 'password';
            
        }
    }
}

