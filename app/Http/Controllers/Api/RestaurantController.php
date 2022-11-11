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
         $restaurants = Restaurant::all();


   /*       $restaurants->each(function($restaurant) {
            if ($restaurant->image) {
               $restaurant->image = asset('storage/' . $restaurant->image);
           } else {
               $restaurant->image = asset('images/no_img.jpg');
           }
           });   */

         return response()->json([
                                   'success'=>true,
                                   'results'=>$restaurants
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
}
