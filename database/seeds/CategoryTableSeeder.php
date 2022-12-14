<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=config('categories');

        foreach($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category['name'];
            $newCategory->image = null;
            $newCategory->save();
        }
    }
}
