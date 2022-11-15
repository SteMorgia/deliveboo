<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = request()->all();
        $restaurants = Restaurant::with('categories')->get();

        $categoriesAsString = ''; // qui salvo le categorie provenienti dal frontend, che sono in formato stringa;
       
        if(array_key_exists('categories', $data)){
            $categoriesAsString = $data['categories'];
        };

        $categoriesAsStringArray = explode(',', $categoriesAsString); // creo un array con gli id delle categorie separati;
        $categoriesAsNumbers = [];

        foreach ($categoriesAsStringArray as $singleCategoryIdAsString) {
            array_push($categoriesAsNumbers, intval($singleCategoryIdAsString)); // converto gli id da stringa a numero e li pusho nell'array;
        }

        // filtro i ristoranti;
        if (count($categoriesAsNumbers) > 0) {
            $filteredRestaurants = [];
            foreach ($restaurants as $restaurant) {
                foreach ($restaurant->categories as $category) {
                    if (in_array($category->id, $categoriesAsNumbers) && !in_array($restaurant, $filteredRestaurants)) {
                        array_push($filteredRestaurants, $restaurant);
                    }
                }
            }
            $restaurants = $filteredRestaurants;
        }

        /*
        $restaurants->each(function($restaurant) {
        if ($restaurant->image) {
            $restaurant->image = asset('storage/' . $restaurant->image);
        } else {
            $restaurant->image = asset('images/no_img.jpg');
        }
        });
        */

         return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        
        if ($restaurant) {
            return response()->json(
                [
                    'success' => true,
                    'result' => $restaurant
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Ristorante non trovato'
                ]
            );
        }
    }         
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getRandomRestaurantsB()
    {
        $restaurants = Restaurant::with('categories')->get();
        $randomRestaurants = $restaurants->random(6);
        return response()->json([
            'success'=> true,
            'results'=> $randomRestaurants
        ]);
    }
}