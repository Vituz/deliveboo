@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

{{-- @include('partials.errors') --}}

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


@section('content')

<div class="container">

    <h1>Aggiungi un nuovo piatto</h1>

    <form action="{{ route('admin.dishes.store') }}" method="post" enctype="multipart/form-data">

        @csrf


        <div class="form-group">
            <input type="text" class="form-control @error('name') is invalid @enderror" name="name" id="name" aria-describedby="nameId" placeholder="Pasta al pomodoro" minlength="1" max="50" value="{{ old('name') }}" max=50 required>
            <small id="nameId" class="form-text text-muted pl-2">Dagli un nome</small>
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- Type --}}
        <div class="form-group">

            <select class="form-control" name="type" id="type" aria-describedby="typeId">
                <option value="" selected disabled>Seleziona il tipo</option>
                @foreach ($datatypes as $key=>$datatype)                
                    <option value="{{$datatype}}">{{$datatype}}</option>
                @endforeach
            </select>
            {{-- <small id="typeId" class="form-text text-muted pl-2">Aggiungi un nuovo tipo</small> --}}
        </div>
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- Type --}}


        {{-- description --}}
        <div class="form-group">
            <textarea class="form-control @error('description') is invalid @enderror" name="description" id="descriptionId" maxlength="100" rows="3" value="">{{ old('description') }}</textarea>
            <small id="descriptionId" class="form-text text-muted pl-2">Aggiungi una descrizione del piatto</small>
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- description --}}


        {{-- ingredients --}}
        <div class="form-group">
            <textarea class="form-control @error('ingredients') is invalid @enderror" name="ingredients" id="ingredientsId" maxlength="50" rows="3" value="">{{ old('ingredients') }}</textarea>
            <small id="ingredientsId" class="form-text text-muted pl-2">Ingredienti</small>
        </div>
        @error('ingredients')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- /ingredients --}}

        {{-- price  --}}
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">&euro;</span>
                </div>
                <input type="text" class="form-control @error('price') is invalid @enderror"  name="price"  id="price" value="{{old('price')}}" required>
              </div>          
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- /price  --}}

        {{--Immagini--}}
        <div class="form-group">

            <input type="file" class="form-control-file  @error('img') is invalid @enderror"  name="img"
                id="img" aria-describedby="imgId"
                value="{{ old('img') }}" max="300">
            <small id="imgId" class="form-text text-muted">Carica un'immagine</small>

        </div>
        @error('img')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{--/Immagini--}}


        {{-- visibility --}}
        <div class="form-group">

            <select class="form-control" name="visibility" id="visibility" aria-describedby="visibilityId" required>
                <option value="" selected disabled>Il piatto sarà visibile?</option>
                <option value="1">Visibile</option>
                <option value="0">Non visibile</option>
            </select>
            {{-- <small id="typeId" class="form-text text-muted pl-2">Add a type</small> --}}
        </div>
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- /visibility --}}


        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
</div>
@endsection