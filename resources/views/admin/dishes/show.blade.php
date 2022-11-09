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

            <form action="{{route('admin.dishes.destroy', ['dish' => $dish->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-1">Elimina</button>
            </form>

        </div>

        <a href="{{route('admin.dishes.index')}}" class="btn btn-primary">Torna alla lista dei tuoi piatti</a>
    </div>

@endsection