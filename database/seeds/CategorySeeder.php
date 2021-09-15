<?php

use App\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories=['Italiano','Indiano','Americano','Cinese','Pizza','Giapponese','Panini','Hamburger'];

        foreach ($categories as $cat) {
            $new_cat= new Category();
            
            $new_cat->name=$cat;
            $new_cat->img=$faker->imageUrl(200,200,null,true);

            $new_cat->save();
        }
    }
}
