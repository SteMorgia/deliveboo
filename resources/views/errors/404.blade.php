@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="alert alert-danger d-inline-block" role="alert">
            {{ $exception->getMessage() }}
        </div>

        <br>
        
        <a href="{{route('admin.restaurants.index')}}" class="btn btn-primary">Torna al tuo ristorante</a>

    </div>

@endsection