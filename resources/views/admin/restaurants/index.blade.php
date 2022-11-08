@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Benvenuto nel tuo ristorante {{$user->name}}</h1> {{-- in alternativa posso scrivere, senza passare variabili dal controller: {{Auth::user()->name}} --}}
        <p>
            @foreach ($restaurants as $restaurant)
                {{$restaurant->name}}
            @endforeach  
            
        </p>
        
    </div>

@endsection




{{--  --}}