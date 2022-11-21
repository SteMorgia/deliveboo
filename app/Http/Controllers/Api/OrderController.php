<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Braintree\Gateway; // importo il gateway;

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

    public function makePayment(Request $request, Gateway $gateway) {
        return 'payment';
    }
}