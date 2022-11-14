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

        \Log::info('--inizio data--');
        \Log::info($data);
        \Log::info('--fine data--');

        $categoriesAsString = ''; // è una lista di numeri (gli id delle categorie ottenute dal front)
       
        if(array_key_exists('categories', $data)){
            $categoriesAsString = $data['categories'];
        };

        //$categoriesAsString = substr($categoriesAsString, 1, -1);

        $provaStringa = '999';
        $provaNumero = intval($provaStringa);
        
        $categoriesAsNumbers = [];
        $test = explode(',', $categoriesAsString);

        \Log::info('----inizio categorieB----');
        \Log::info($categoriesAsString);
        \Log::info($provaStringa);
        \Log::info(gettype($provaNumero));
        \Log::info(gettype($categoriesAsString));
        \Log::info(gettype($test));
        \Log::info('----fine categorieB----');

        foreach ($test as $testa) {
            array_push($categoriesAsNumbers, intval($testa));
        }

        \Log::info('----inizio categorie numeri----');
        \Log::info($categoriesAsNumbers);
        \Log::info('----fine categorie numeri----');

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

        \Log::info('----inizio filteredRestaurants----');
        \Log::info($restaurants);
        \Log::info('----fine filteredRestaurants----');

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
            'results' => $restaurants,
            //'pippo' => $filteredRestaurants,
            //'categoriesAsString' => $categoriesAsString,
            //'test' => $test,
            //'categoriesAsNumbers' => $categoriesAsNumbers,
            //'data' => $data
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
            if($restaurant) {
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
                        'message' => 'restaurant not found!'
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

    public function test()
    {
        $restaurants = Restaurant::with('categories')->get();
        return response()->json([
            'success'=>true,
            'results'=>$restaurants
        ]);
    }
}