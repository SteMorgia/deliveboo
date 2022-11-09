@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Ecco il ristorante:</h1>

        @foreach ($restaurant as $restaurant)
        <div class="card mb-3">
            <img class="card-img-top" src="{{asset('images/ristorante1.jpeg')}}" alt="{{$restaurant->name}}">
            <div class="card-body">
                <h5 class="card-title">Nome: {{$restaurant->name}}</h5>
                <p class="card-text">Indirizzo: {{$restaurant->address}}</p>
                <p class="card-text">Telefono: {{$restaurant->phone_number}}</p>
                <p class="card-text">P.IVA: {{$restaurant->vat}}</p>
                <p class="card-text">Descrizione: {{$restaurant->description}}</p>
                <a href="{{route('admin.home')}}" class="btn btn-primary">Torna alla tua homepage</a>
            </div>
        </div>
        @endforeach
    </div>

@endsection