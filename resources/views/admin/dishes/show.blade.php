@extends('layouts.app')

@section('content')

    <div class="container">

        {{--
            PLACEHOLDER IMMAGINI PIATTI
            <img class="card-img-top" src="..." alt="Card image cap">
        --}}
        <div class="card-body">
            <h5 class="card-title">{{$dish->name}}</h5>
            <p class="card-text">Descrizione: <br> {{$dish->description}}</p>
            <p class="card-text">Prezzo: {{$dish->price}} €</p>
            <a href="#" class="btn btn-warning m-1">Modifica</a><br>
            <a href="#" class="btn btn-danger m-1">Elimina</a>
        </div>

        <a href="{{route('admin.dishes.index')}}" class="btn btn-primary">Torna alla lista dei tuoi piatti</a>
    </div>

@endsection