<?php

use Illuminate\Database\Seeder;
use App\Dish;

class DishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes=config('dishes');

        foreach($dishes as $dish) {
            $newDish = new Dish();
            $newDish->restaurant_id = $dish['restaurant_id'];
            $newDish->name = $dish['name'];
            $newDish->description = $dish['description'];
            $newDish->price = $dish['price'];
            $newDish->visibility = true;
            $newDish->slug = $dish['slug'];
            $newDish->image = 'cover/lasagne.jpg'; // inserire immagine lasagne in storage/app/public/cover;
            $newDish->save();
        }
    }
}