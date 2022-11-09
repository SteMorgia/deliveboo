@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Ecco i piatti del tuo ristorante:</h1>

    <div class="container d-flex">

        @foreach ($dishes as $dish)
            <div class="card m-2" style="width: 18rem;">
                {{-- 
                    PLACEHOLDER IMMAGINI PIATTI
                    <img class="card-img-top" src="..." alt="Card image cap">
                --}}
                <div class="card-body">
                    <h5 class="card-title">{{$dish->name}}</h5>
                    <p class="card-text">Descrizione: <br> {{$dish->description}}</p>
                    <p class="card-text">Prezzo: {{$dish->price}} €</p>
                    <a href="#" class="btn btn-primary m-1">Vedi piatto</a><br>
                    <a href="#" class="btn btn-warning m-1">Modifica piatto</a><br>
                    <a href="#" class="btn btn-danger m-1">Elimina piatto</a>
                </div>
            </div>  
        @endforeach

    </div>

    <a href="{{route('admin.restaurants.index')}}" class="btn btn-primary">Torna al tuo ristorante</a>
    <a href="{{route('admin.home')}}" class="btn btn-primary">Torna alla tua homepage</a>
</div>
    

@endsection