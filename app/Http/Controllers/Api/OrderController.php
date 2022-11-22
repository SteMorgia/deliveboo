<?php

namespace App\Http\Controllers\Api;


use App\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    public function generate(Request $request, Gateway $gateway) {
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data);
    }

    public function makePayment(OrderRequest $request, Gateway $gateway) {

        $result = $gateway->transaction()->sale([

            'amount' => $request->amount,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]

        ]);

        if ( $result->success ) {

            $data = [
                'success' => true,
                'message' => 'Transazione eseguita'
            ];

            $this->newOrder($request, $result);

            return response()->json($request);
            
        } else {
            
            $data = [
                'success' => false,
                'message' => 'Transazione fallita'
            ];
            
            return response()->json($data, 401);
        
        }
	}

    public function newOrder(OrderRequest $request, $result) {

        $request->validate(
            [
                'name' => 'required|string|max:30|min:3',
                'address' => 'required|string|max:255|min:6',
                'phone_number' => 'required|string|max:30|min:6',
                'amount' => 'required|digits_between:0,9999.99',
                'cart' => 'required|array'
            ],
            [
                'name.required' => 'Inserisci nome e cognome',
                'name.max' => 'Inserisci massimo 30 lettere',
                'name.min' => 'Inserisci almeno 3 lettere',
                'address.required' => 'Inserisci un indirizzo',
                'address.max' => 'L\' indirizzo deve avere massimo 255 caratteri',
                'address.min' => 'L\'indirizzo deve avere almeno 6 caratteri',
                'phone_number.required' => 'Inserire il numero di telefono',
                'phone_number.max' => 'Il numero di telefono deve avere massimo 30 numeri',
                'phone_number.min' => 'Il numero di telefono deve avere almeno 6 numeri',
                'cart.required' => 'Aggiungi piatti a carrello',
            ]
        );

        $newOrder = new Order();
        $newOrder->name = $request->name;
        $newOrder->address = $request->address;
        $newOrder->phone_number = $request->phone_number;
        $newOrder->total_price = $request->amount;

        if ( $result->success == true ) {
            $newOrder->payment_approved	= true;
        };

        $newOrder->save();

        // inizio tabella pivot
        $dishesIdArray = []; //1,2,3
        $dishesQuantityArray = []; //20,40,60
        foreach ( $request->cart as $cartDish ) {
            $dishesIdArray[] = $cartDish['id'];
            $dishesQuantityArray[] = $cartDish['quantity'];
        };

        $syncDishIdQuantity = [];
        for ( $k = 0; $k < count($dishesIdArray); $k++ ) {
            $syncDishIdQuantity[ $dishesIdArray[$k] ] = [ 'quantity' => $dishesQuantityArray[$k] ];
        };

        $newOrder->dishes()->sync($syncDishIdQuantity);
        // fine tabella pivot

        if ( $newOrder ) {
            return 'Nuovo ordine salvato';
        } else {
            return 'Nuovo ordine NON salvato';
        }
    }
}