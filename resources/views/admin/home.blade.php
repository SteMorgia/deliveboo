@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Bentornato {{$user->name}}.</h1>
        @if ($user->restaurant)
            <a href="{{route('admin.restaurant.index')}}" class="btn btn-primary">Vai al tuo ristorante</a>
        @else
            <hr>
            <h4>Non hai ancora un tuo ristorante!</h4>
            <a href="{{route('admin.restaurant.create')}}" class="btn btn-primary">Crea il tuo ristorante</a>
        @endif
    </div>

@endsection