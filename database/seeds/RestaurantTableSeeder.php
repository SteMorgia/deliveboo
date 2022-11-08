<?php

use Illuminate\Database\Seeder;
use App\Restaurant;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants=config('restaurants');

        foreach($restaurants as $restaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->name = $restaurant['restaurant_name'];
            $newRestaurant->address = $restaurant['restaurant_address'];
            $newRestaurant->phone_number = $restaurant['phone_number'];
            $newRestaurant->description = $restaurant['restaurant_description'];
            $newRestaurant->image = $restaurant['restaurant_image'];
            $newRestaurant->vat = $restaurant['vat_number'];
            $newRestaurant->user_id = $restaurant['user_id'];
            $newRestaurant->save();
        }
    }
}
