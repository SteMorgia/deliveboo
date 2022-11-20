<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('restaurants', 'Api\RestaurantController@index');
Route::get('categories', 'Api\CategoryController@index');
Route::get('filterRestaurants', 'Api\RestaurantController@getRandomRestaurantsB'); // filtraggio ristoranti homepage;
Route::get('filterRestaurants/{slug}', 'Api\RestaurantController@show'); // filtraggio singolo ristorante singlePageRestaurant;
Route::get('filterDishes/{id}', 'Api\RestaurantController@filterDishes'); // filtraggio piatti per singolo ristorante singlePageRestaurant;

// seguono le rotte per braintree;
Route::get('orders/generate', 'Api\OrderController@generateToken'); // per generare il token che autorizza il rendering in pagina del modulo di pagamento;
Route::post('orders/make/payment', 'Api\OrderController@makePayment'); // per effettuare il pagamento;