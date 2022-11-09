<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', $user->id)->get();
        return view('admin.restaurants.index', compact('restaurant','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('admin.restaurants.create', compact('user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|min:1|string',
            'address' => 'required|max:255|min:6|string',
            'phone_number' => 'required|digits_between:6,30',
            'description' => 'nullable|max:65535|string',
            'vat' => 'required|numeric|digits:11',
            'categories' => 'exists:categories,id'
        ]);

        $data = $request->all();

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);
        $id = Auth::id();
        $newRestaurant->user_id = $id;
        $newRestaurant->save();

        if (array_key_exists('categories', $data)) {
            $newRestaurant->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.restaurants.index')->with('status', 'Ristorante creato con successo.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        
    }
}
