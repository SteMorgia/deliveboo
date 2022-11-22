<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // controlla i dati in ingresso nella $request della makePyament() in api\orderController;
        return [
            'token' => 'required',
            'amount' => 'required'
            // 'product' => 'required' // prendo l'id in ingresso del singolo piatto, verificando che esista nel db;
        ];
    }
}
