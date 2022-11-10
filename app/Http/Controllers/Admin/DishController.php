<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Dish;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $restaurant = Restaurant::find($id);
        if ($restaurant === null) {
            abort(404, 'Non esistono piatti per questo ristorante');
        };
        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();
    
        return view('admin.dishes.index', compact('dishes', 'id', 'restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::id();
        $restaurant = Restaurant::find($id);

        return view('admin.dishes.create', compact('id', 'restaurant'));
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
            'name' => 'required|max:50|min:3|string',
            'description' => 'required|max:1000|min:10|string',
            'price' => 'required|numeric|between:0,999.99',
            'visibility' => 'required|boolean'
        ],
        [
            'name.required' => 'Inserisci il nome (almeno tre caratteri)',
            'name.min' => 'Il nome deve avere almeno tre caratteri',
            'name.max' => 'Il nome può essere al massimo di 50 caratteri',
            'description.required' => 'Inserisci una descrizione',
            'description.max' => 'La descrizione deve avere massimo 1000 caratteri',
            'description.min' => 'La descrizione deve avere minimo 10 caratteri',
            'price.required' => 'Inserisci un prezzo',
            'price.numeric' => 'Inserisci un numero',
            'price.between' => 'Inserisci un numero compreso tra 0 e 999.99',
            'visibility.required' => 'Scegli se rendere il piatto visibile',
        ]);

        $data = $request->all();

        $newDish = new Dish();
        $newDish->fill($data);

        $id = Auth::id();
        // $restaurant = Restaurant::find($id);

        $newDish->restaurant_id = $id;
        $newDish->save();

        return redirect()->route('admin.dishes.index')->with('status', 'Piatto creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dish = Dish::find($id);
        return view('admin.dishes.show', compact('dish'));
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
        $dish = Dish::find($id);
        if ($dish) {
            $dish->delete();
            return redirect()->route('admin.dishes.index')->with('status', 'Piatto cancellato con successo');
        } else {
            abort(404, 'Non esiste il piatto da cancellare');
        }
    }
}