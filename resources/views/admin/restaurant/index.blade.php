@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="d-flex justify-content-center">
            @foreach ($restaurant as $restaurant)

                <div class="card mb-5" style="width: 54rem;">
                    @if ($restaurant->image)
                        <img class="card-img-top" src="{{asset('storage/' . $restaurant->image)}}" alt="{{$restaurant->name}}">
                    @else
                        <img class="card-img-top" style="width:20%" src="{{asset('images/no_img.jpg')}}" alt="{{$restaurant->name}}">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{{$restaurant->name}}</h5>
                        <p class="card-text">Indirizzo: <br> {{$restaurant->address}}</p>
                        <p class="card-text">Telefono: <br> {{$restaurant->phone_number}}</p>
                        <p class="card-text">P.IVA: {{$restaurant->vat}}</p>

                        @if ($restaurant->description)
                            <p class="card-text">Descrizione: <br> {{$restaurant->description}}</p>                           
                        @endif
                        
                        <div class="text-right">
                            <a href="{{route('admin.dishes.index')}}" class="btn text-white mr-2" style="background-color:#e53170;">Vai ai piatti del tuo ristorante</a>
                            <a href="{{route('admin.orders.index')}}" class="btn text-white" style="background-color:#e53170;">Vai agli ordini del tuo ristorante</a>
                        </div>                        
                    </div>
                </div>
            @endforeach
        </div>     

        <a href="{{route('admin.home')}}" class="btn" style="background-color:#ff8906;">Torna alla tua homepage</a>

    </div>

@endsection