@extends('layouts.app')

@section('content')

    <div class="container">

        <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <h1 class="mb-4">Aggiungi ristorante</h1>

            <div class="form-group mb-3">
                <label for="name">Nome ristorante</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                    name="name" minlength='1' maxlength="50" required />

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="address">Indirizzo</label>
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                    name="address" minlength="6" maxlength="255" required />

                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="phone_number">Numero di telefono</label>
                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}"
                    name="phone_number" maxlength="30" required />

                @error('phone_number')
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
                maxlength="65535"
                >
                    {{ old('description') }}
                </textarea>

                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="vat">Partita IVA</label>
                <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" value="{{ old('vat') }}"
                    name="vat"
                    maxlength="11"
                    required />

                @error('vat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <p>Categorie</p>
            <div class="card p-3">
                @foreach ($categories as $category)
                    <div class="form-group form-check">
                        <input {{(in_array($category->id, old('categories', [])))?'checked':''}}
                            name="categories[]"
                            type="checkbox"
                            class="form-check-input"
                            value="{{$category->id}}"
                            id="{{$category->name}}"
                        />
                        <label class="form-check-label" for="{{$category->name}}">{{$category->name}}</label>
                    </div>
                @endforeach

                @error('categories')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="coverId">Immagine</label>
                <input class="form-control-file @error('cover') is-invalid @enderror"
                    type="file"
                    id="coverId"
                    name="cover"
                    accept=".jpg,.jpeg,.png"
                    required />

                @error('cover')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="mt-3 btn btn-primary">Crea ristorante</button>

        </form>

    </div>

@endsection