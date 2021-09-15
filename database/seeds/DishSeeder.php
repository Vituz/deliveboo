<?php
use App\Dish;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run(Faker $faker)
    // {
    //     for($i=0; $i<20; $i++){
    //         $dish=new Dish();
    //         $dish->user_id = $faker->numberBetween(1, 10);
    //         $dish->name=$faker->text(5);
    //         $dish->type=$faker->randomElement(['Antipasti', 'Primi', 'Secondi', 'Dolci', 'Contorni']);
    //         $dish->description=$faker->text(20);
    //         $dish->ingredients=$faker->text(30);
    //         $dish->price=$faker->randomFloat(2, 10,200);
    //         $dish->img=$faker->imageUrl(640, 300, null, true, $dish->name);
    //         $dish->visibility=$faker->boolean();
    //         $dish->save();
    //     }
    // }
}

