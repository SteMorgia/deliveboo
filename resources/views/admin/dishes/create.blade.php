@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <h1 class="mb-4">Aggiungi piatto</h1>

            <div class="form-group mb-3">
                <label for="name">Nome</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    name="name"
                    minlength="3"
                    maxlength="50"
                    required />

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="description">Descrizione</label>
                <textarea class="form-control  @error('description') is-invalid @enderror"
                id="description"
                name="description"
                minlength="10"
                maxlength="1000">
                    {{ old('description') }}
                </textarea>

                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="price">Prezzo</label>
                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price') }}"
                    name="price"
                    step='0.01'
                    min='0'
                    max='999.99'
                    required />

                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="mt-3 btn btn-primary">Crea piatto</button>
        
            {{--
            GESTIONE UPLOAD IMMAGINI

            <div class="form-group mb-3">
                <label for="cover">Immagine: </label>
                <input type="file" name="image" id="cover" class="form-control-file @error('image') is-invalid @enderror" />

                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            --}}

        </form>

        <br>

        <a href="{{route('admin.dishes.index')}}" class="btn btn-primary">Torna alla lista dei piatti</a>

    </div>

@endsection