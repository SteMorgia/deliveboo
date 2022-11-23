@extends('layouts.app')

@section('content')

    <div class="container">

        @if ( count($orders) > 0 )
        
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Nome e Cognome</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">Numero di telefono</th>
                    <th scope="col">Totale</th>
                    <th scope="col">Piatti ordinati</th>

                    </tr>
                </thead>

                    @foreach ( $orders as $order )
                    <tbody>
                        <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->phone_number }}</td>
                        <td>{{ $order->total_price }} €</td>
                        <td>
                            @foreach ( $order->dishes as $dish )
                                {{ $dish->name . ' x ' . $dish->pivot->quantity }} <br>
                            @endforeach
                        </td>
                        </tr>
                    </tbody>

                @endforeach
                    

            </table>

        @else
            
            <h1 class="mb-3">Questo ristorante non ha ordini.</h1>

        @endif


        <a class="btn btn-primary" href='{{route('admin.restaurant.index')}}'>Torna al tuo ristorante</a>
        
    </div>

@endsection