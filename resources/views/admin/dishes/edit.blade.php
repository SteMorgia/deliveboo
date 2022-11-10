@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="mb-4">Modifica piatto</h1>


        @if ($dish->image !== null)
            <form class="btn btn-danger mb-3"
                action="{{route('admin.dishes.deleteDishImage', ['dish' => $dish])}}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Cancella solo l'immagine del piatto</button>
            </form>
        @endif

        <form action="{{ route('admin.dishes.update', ['dish' => $dish]) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="form-group">
                @if ($dish->image)
                    <img class="card-img-top mb-3" style="max-width: 30rem" src="{{asset('storage/' . $dish->image)}}" alt="{{$dish->name}}">
                @elseif (!$dish->image)
                    <p>Il piatto non ha nessuna immagine</p>
                @endif

                <br>

                <label for="coverId">Nuova immagine</label>
                <input type="file" name="cover" id="coverId" class="form-control-file @error('cover') is-invalid @enderror" />

                @error('cover')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="name">Nome</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $dish->name) }}"
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
                    {{ old('description', $dish->description) }}
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
                    value="{{ old('price', $dish->price) }}"
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

            <div class="form-group mb-3">
                <label for="visibilityId">Visibilità</label>
                <select id="visibilityId" name="visibility" class="form-control @error('category_id') is-invalid @enderror" required>
                    {{-- <option {{(old('visibility')=="")?'selected':''}} value="">Nessuna opzione selezionata</option> --}}
                    <option {{(old('visibility', $dish->visibility)==0)?'selected':''}} value=0>Non visibile</option>
                    <option {{(old('visibility', $dish->visibility)==1)?'selected':''}} value=1>Visibile</option>
                </select>

                @error('visibility')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        
            <button type="submit" class="mt-3 btn btn-primary">Modifica piatto</button>

        </form>

        <a href="{{route('admin.dishes.index')}}" class="btn btn-primary mt-3">Torna alla lista dei piatti</a>

    </div>

@endsection