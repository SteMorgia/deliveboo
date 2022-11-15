@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Ecco il tuo ristorante, {{$user->name}}:</h1>

        @foreach ($restaurant as $restaurant)

        <div class="card mb-3">
            @if ($restaurant->image)
                <img class="card-img-top" src="{{asset('storage/' . $restaurant->image)}}" alt="{{$restaurant->name}}">
            @else
                <img class="card-img-top" style="width:20%" src="{{asset('images/no_img.jpg')}}" alt="{{$restaurant->name}}">
            @endif

            <div class="card-body">
                <h5 class="card-title">Nome: {{$restaurant->name}}</h5>
                <p class="card-text">Indirizzo: {{$restaurant->address}}</p>
                <p class="card-text">Telefono: {{$restaurant->phone_number}}</p>
                <p class="card-text">P.IVA: {{$restaurant->vat}}</p>
                <p class="card-text">Descrizione: {{$restaurant->description}}</p>
                <a href="{{route('admin.dishes.index')}}" class="btn btn-primary">Vai ai piatti del tuo ristorante</a>
            </div>
        </div>
        @endforeach

        <a href="{{route('admin.home')}}" class="btn btn-primary">Torna alla tua homepage</a>

    </div>

@endsection