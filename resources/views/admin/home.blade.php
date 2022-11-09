@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Bentornato {{$user->name}}.</h1>
        @if ($user->restaurant)
            <a href="{{route('admin.restaurants.index')}}" class="btn btn-primary">Vai al tuo ristorante</a>
        @else
            {{-- <a href="{{route('admin.restaurants.create')}}" class="btn btn-primary">Vai al tuo ristorante</a> --}}
        @endif
    </div>

@endsection