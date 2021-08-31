<?php

use App\Order;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 20; $i++) {
            $order = new Order();

            $order->user_id = $faker->numberBetween(1, 10);
            $order->ui_name = $faker->word();
            $order->ui_surname = $faker->word();
            $order->ui_email = $faker->email();
            $order->ui_address = $faker->address();
            $order->ui_phone_number = $faker->numerify('##########');
            $order->amount = $faker->randomFloat(2, 9.99, 299.99);

            $order->save();
        }
    }
}
