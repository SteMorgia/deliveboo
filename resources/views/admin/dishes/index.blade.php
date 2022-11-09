@extends('layouts.app')

@section('content')
<div class="container">
    @if ($dishes)
            <h1>Ecco i piatti del tuo ristorante:</h1>

            <a href="{{route('admin.dishes.create')}}" class="btn btn-success">Crea un nuovo piatto</a>

            <div class="container d-flex flex-wrap">

                @foreach ($dishes as $dish)
                    <div class="card m-2" style="width: 20rem;">
                        {{-- 
                            PLACEHOLDER IMMAGINI PIATTI
                            <img class="card-img-top" src="..." alt="Card image cap">
                        --}}
                        <div class="card-body">
                            <h5 class="card-title">{{$dish->name}}</h5>
                            <p class="card-text">Descrizione: <br> {{$dish->description}}</p>
                            <p class="card-text">Prezzo: {{$dish->price}} €</p>
                            <a href="{{route('admin.dishes.show', ['dish' => $dish->id])}}" class="btn btn-primary m-1">Vedi</a><br>
                        </div>
                    </div>
                @endforeach

            </div>
    @else
        <h1>Non hai piatti per il tuo ristorante.</h1>
        <a href="{{route('admin.dishes.create')}}" class="btn btn-primary">Crea piatti</a>
    @endif
    <a href="{{route('admin.restaurants.index')}}" class="btn btn-primary">Torna al tuo ristorante</a>
</div>

@endsection