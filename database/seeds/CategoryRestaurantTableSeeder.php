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
            [13],
            [24],
            [23, 13],
            [19],
            [18, 14],
            [20]
        ];

        $k = 0;
        for ($i = 7; $i < 13; $i++) {
            $restaurant = Restaurant::find($i);
            $restaurant->categories()->sync($categories[$k]);
            $k++;
            $restaurant->save();
        }
    }
}

