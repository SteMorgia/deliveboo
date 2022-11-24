@extends('layouts.app')

@section('content')

    <div class="container-fluid my-container d-flex justify-content-center align-items-center text-center">
    
        <span> Bentornato {{$user->name}} </span>

        @if ($user->restaurant)
            <a href="{{route('admin.restaurant.index')}}" class="btn my-btn" style="background-color:#ff8906;">Vai al tuo ristorante</a>
        @else
            <hr>
            <h4>Non hai ancora un tuo ristorante!</h4>
            <a href="{{route('admin.restaurant.create')}}" class="btn my-btn" style="background-color:#ff8906;">Crea il tuo ristorante</a>
        @endif

    </div>

@endsection