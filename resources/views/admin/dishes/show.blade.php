@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="card mb-5" style="width: 36rem;">
            <div class="card-body p-2">

                @if ($dish->image != null)
                    <img class="card-img-top mb-2" src="{{asset('storage/' . $dish->image)}}" alt="{{$dish->name}}">
                @else
                    <img class="card-img-top mb-2" src="{{asset('images/no_img.jpg')}}" alt="No image">
                @endif
    
                <h5 class="card-title font-weight-bold">{{$dish->name}}</h5>
                <p class="card-text">Descrizione: <br> {{$dish->description}}</p>
                <p class="card-text font-weight-bold">Prezzo: <br> {{$dish->price}} €</p>
                <a href="{{route('admin.dishes.edit', ['dish' => $dish->slug])}}" class="btn btn-warning mr-1">Modifica</a>
    
                <form class="d-inline" action="{{route('admin.dishes.destroy', ['dish' => $dish->id])}}" method="POST" onsubmit="return confirm('Confermi di voler cancellare il piatto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mx-1">Elimina</button>
                </form>
            </div>
        </div>

        

        <a href="{{route('admin.dishes.index')}}" class="btn" style="background-color:#ff8906;">Torna alla lista dei tuoi piatti</a>
    </div>
@endsection