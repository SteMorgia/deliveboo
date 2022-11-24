@extends('layouts.app')

@section('content')

    <div class="container-fluid my-container">
        <div class="text-center">
            @if ($user->restaurant)   
                <h1 class="mb-5"> Bentornato {{$user->name}}! </h1>
                <a href="{{route('admin.restaurant.index')}}" class="btn" style="background-color:#ff8906;">Vai al tuo ristorante</a>         
            @else  
                <h1 class="mb-5"> Non hai ancora un tuo ristorante! </h1>
                <a href="{{route('admin.restaurant.create')}}" class="btn" style="background-color:#ff8906;">Crea il tuo ristorante</a>
            @endif 
        </div>         
    </div>   

@endsection