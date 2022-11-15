<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Restaurant;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        return view('admin.restaurant.index', compact('restaurant','user'));
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
        return view('admin.restaurant.create', compact('user', 'categories'));
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
            'cover' => 'mimes:jpg,jpeg,png|max:8000',
            'categories' => 'exists:categories,id'
        ],
        [
            'name.required' => 'Inserisci il nome (almeno un carattere)',
            'name.min' => 'Il nome deve avere almeno un carattere',
            'name.max' => 'Il nome può essere al massimo di 50 caratteri',
            'address.required' => 'Inserisci un indirizzo',
            'address.max' => 'L\'indirizzo deve contenere almeno 6 caratteri',
            'address.max' => 'L\'indirizzo può essere al massimo di 255 caratteri',
            'phone_number.required' => 'Inserisci un numero valido',
            'phone_number.digits_between' => 'Il numero deve avere tra le 6 e le 30 cifre',
            'description.max' => 'La descrizione deve avere massimo 65535 caratteri',
            'vat.required' => 'Inserisci la partita iva',
            'vat.numeric' => 'La partita iva deve essere un numero',
            'vat.digits' => 'La partita iva deve essere di 11 numeri',
            'cover.mimes' => 'Caricare un\'immagine in formato jpg, jpeg o png',
            'cover.max' => 'L\'immagine deve pesare massimo 8 mb'
        ]);

        $data = $request->all();

        $image_path = Storage::put('cover', $data['cover']);
        $data['image'] = $image_path;

        $slug = $this->calculateSlug($data['name']);
        $data['slug'] = $slug;

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);

        $id = Auth::id();
        $newRestaurant->user_id = $id;
        
        $newRestaurant->save();

        if (array_key_exists('categories', $data)) {
            $newRestaurant->categories()->sync($data['categories']);
        }

        return redirect()->route('admin.restaurant.index')->with('status', 'Ristorante creato con successo.');
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

    protected function calculateSlug($name) {
        $slug = Str::slug($name, '-');
        $checkRestaurant = Restaurant::where('slug', $slug)->first();
        $counter = 1;
        while ($checkRestaurant) {
            $slug = Str::slug($name . '-' . $counter, '-');
            $counter++;
            $checkRestaurant = Restaurant::where('slug', $slug)->first();
        }
        return $slug;
    }
}