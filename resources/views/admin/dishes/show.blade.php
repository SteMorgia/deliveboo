@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="card-body max-width: 30%;">

            @if ($dish->image != null)
                <img class="card-img-top mb-3" style="max-width: 30rem" src="{{asset('storage/' . $dish->image)}}" alt="{{$dish->name}}">
            @else
                <img class="card-img-top mb-3" style="max-width: 30rem" src="{{asset('images/no_img.jpg')}}" alt="No image">
            @endif

            <h5 class="card-title">{{$dish->name}}</h5>
            <p class="card-text">Descrizione: <br> {{$dish->description}}</p>
            <p class="card-text">Prezzo: {{$dish->price}} €</p>
            <a href="{{route('admin.dishes.edit', ['dish' => $dish->slug])}}" class="btn btn-warning m-1">Modifica</a><br>

            <form action="{{route('admin.dishes.destroy', ['dish' => $dish->id])}}" method="POST" onsubmit="return confirm('Confermi di voler cancellare il piatto?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mx-1">Elimina</button>
            </form>
        </div>

        <a href="{{route('admin.dishes.index')}}" class="btn btn-primary">Torna alla lista dei tuoi piatti</a>
    </div>
@endsection