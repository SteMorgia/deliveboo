<?php

use Illuminate\Database\Seeder;
use App\Restaurant;

class CategoryRestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [0],
            [1],
            [12],
            [1, 11],
            [7],
            [2, 6],
            [8]
        ];

        for ($i = 1; $i < 7; $i++) {
            $restaurant = Restaurant::find($i);
            $restaurant->categories()->sync($categories[$i]);
            $restaurant->save();
        }
    }
}