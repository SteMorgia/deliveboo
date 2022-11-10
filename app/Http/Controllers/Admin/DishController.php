<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Dish;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

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
            'visibility' => 'required|boolean',
            'cover' => 'nullable|mimes:png,jpg,jpeg'
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
            'cover.mimes' => 'Caricare un\'immagine in formato png, jpg o jpeg',
            'cover.max' => 'L\'immagine deve pesare massimo 8 mb'
        ]);

        $data = $request->all();

        $image_path = Storage::put('cover', $data['cover']);
        $data['image'] = $image_path;

        $newDish = new Dish();

        $slug = $this->calculateSlug($data['name']);
        $data['slug'] = $slug;

        $newDish->fill($data);

        $id = Auth::id();
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
    public function show($slug)
    {
        // $dish = Dish::find($id);
        $dish = Dish::where('slug', $slug)->first();
        return view('admin.dishes.show', compact('dish'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $dish = Dish::where('slug', $slug)->first();
        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $request->validate([
            'name' => 'required|max:50|min:3|string',
            'description' => 'required|max:1000|min:10|string',
            'price' => 'required|numeric|between:0,999.99',
            'visibility' => 'required|boolean',
            'cover' => 'nullable|mimes:png,jpg,jpeg'
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
            'cover.mimes' => 'Caricare un\'immagine in formato png, jpg o jpeg',
            'cover.max' => 'L\'immagine deve pesare massimo 8 mb'
        ]);

        $data = $request->all();

        if (array_key_exists('cover', $data)) {
            if ($dish->image) {
                Storage::delete($dish->image);
            }
            $image_path = Storage::put('cover', $data['cover']);
            $data['image'] = $image_path;
        }

        if ($dish->name !== $data['name']) {
            $data['slug'] = $this->calculateSlug($data['name']);
        }

        $dish->update($data);

        return redirect()->route('admin.dishes.index')->with('status', 'Piatto modificato con successo');
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

    protected function calculateSlug($name) {
        $slug = Str::slug($name, '-');
        $checkDish = Dish::where('slug', $slug)->first();
        $counter = 1;
        while($checkDish) {
            $slug = Str::slug($name . '-' . $counter, '-');
            $counter++;
            $checkDish = Dish::where('slug', $slug)->first();
        }
        return $slug;
    }
}