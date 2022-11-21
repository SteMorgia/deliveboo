<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Braintree\Gateway; // importo il gateway;
use App\Http\Requests\Orders\OrderRequest; // importo la classe della request;

class OrderController extends Controller
{
    public function generateToken(Request $request, Gateway $gateway) {
        
        $token = $gateway->clientToken()->generate(); // genero primo token per autorizzare la creazione del form di pagamento nel frontend;
        $data = [
            'succes' => true,
            'token' => $token
        ];

        return response()->json($data);
    }

    public function makePayment(OrderRequest $request, Gateway $gateway) {

        // la $request, in ingresso dal frontend tramite metodo POST, conterrà il token NONCE + il carrello;

        // creo una nuova transazione di vendita (le chiavi sono obbligatorie - vedi la documentazione di Braintree);
        $result = $gateway->transaction()->sale([

            'amount' => $request->amount, // sarà il totale del carrello, inviato dal frontend e contenuto nella $request;
            'paymentMethodNonce' => $request->token, // NON è il token della generateToken(), ma un altro token generato dal plugin del frontend (il form di pagamento) che è contenuto nella $request;
            'options' => [
                'submitForSettlement' => true
            ]

        ]);

        // gestisco il successo o meno della transazione (può fallire perché il token NONCE, inviato a Braintree, non è valido);
        if ( $result->success ) {

            $data = [
                'succes' => true,
                'message' => 'Transazione eseguita con successo!'
            ];

            return response()->json($data);

        } else {

            $data = [
                'succes' => false,
                'message' => 'Transazione fallita!'
            ];

            return response()->json($data);

        }
    }
}