@extends('layouts.app')

@section('content')
    <div class="container">

            <a href="{{route('admin.restaurant.index')}}" class="btn btn-primary">Torna al tuo ristorante</a>
            <a href="{{route('admin.dishes.create')}}" class="btn btn-success">Crea un nuovo piatto</a>

            <hr>

            @if (count($dishes))
                <h1>Ecco i piatti del tuo ristorante:</h1>

                <div class="container d-flex flex-wrap">

                    @foreach ($dishes as $dish)
                        <div class="card m-2" style="width: 20rem;">

                        @if ($dish->image != null)
                            <img class="card-img-top" src="{{asset('storage/' . $dish->image)}}" alt="{{$dish->name}}">
                        @else
                            <img class="card-img-top" src="{{asset('images/no_img.jpg')}}" alt="{{$dish->name}}">
                        @endif

                            <div class="card-body">
                                <h5 class="card-title">{{$dish->name}}</h5>
                                <p class="card-text">Descrizione: <br> {{$dish->description}}</p>
                                <p class="card-text">Prezzo: {{$dish->price}} €</p>
                                <p class="card-text">Visibile: {{$dish->visibility?'Sì':'No'}}</p>
                                <a href="{{route('admin.dishes.show', ['dish' => $dish->slug])}}" class="btn btn-primary m-1">Vedi</a>
                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <h1>
                    Non hai ancora piatti nel tuo ristorante.
                    <br>
                    Creane uno con il pulsante in alto.
                </h1>
            @endif

    </div>
@endsection