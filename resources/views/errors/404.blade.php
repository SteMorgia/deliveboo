@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="alert alert-danger d-inline-block" role="alert">
            {{ $exception->getMessage() }}
        </div>

        <br>
        
        <a href="{{route('admin.restaurant.index')}}" class="btn btn-primary">Torna al tuo ristorante</a>
        <a href="{{route('admin.restaurant.create')}}" class="btn btn-success">Crea il tuo piatto</a>

    </div>

@endsection