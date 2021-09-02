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



<div class="container">
    @if(Auth::user()->id == $dish->user_id)
    <h1>Edit single dish</h1>
    <form action="{{ route('admin.dishes.update', $dish->id) }}" method="post" enctype="multipart/form-data">

        @csrf
        @method('PUT')
    
        <div class="form-group">
            <input type="text" class="form-control @error('name') is invalid @enderror" name="name" id="name"
                aria-describedby="nameId" placeholder="Dish" minlength="1" max="50" value="{{ $dish->name}}"
                max=50 required>
            <small id="nameId" class="form-text text-muted pl-2">Inserisci nome piatto</small>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- Type --}}
        <div class="form-group">

            <select class="form-control" name="type" id="type" aria-describedby="typeId">
                @foreach ($datatypes as $key=>$datatype)                
                    <option value="{{$datatype}}" {{$datatype==$dish->type ? 'selected' : '' }}>{{$datatype}}</option>
                @endforeach
            </select>
            {{-- <small id="typeId" class="form-text text-muted pl-2">Add a type</small> --}}
        </div>
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- Type --}}


        {{-- description --}}
        <div class="form-group">
            <textarea class="form-control @error('description') is invalid @enderror" name="description" id="descriptionId" rows="3"
            value="" >{{$dish->description}}</textarea>
            <small id="descriptionId" class="form-text text-muted pl-2">Add a description</small>
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- description --}}


        {{-- ingredients --}}
        <div class="form-group">
            <textarea class="form-control @error('ingredients') is invalid @enderror" name="ingredients" id="ingredientsId" rows="3"
            value="" >{{$dish->ingredients}}</textarea>
            <small id="ingredientsId" class="form-text text-muted pl-2">Ingredients</small>
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
                <input type="text" class="form-control" name="price"  id="price" required value="{{$dish->price}}">
              </div>          

        @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        {{-- /price  --}}
   
    {{--Immagini--}}
        <div class="form-group">
            <input type="file" class="form-control-file @error('img') is invalid @enderror" name="img"
                id="img" aria-describedby="imgId" max="300">
            <small id="imgId" class="form-text text-muted">Place an Url image</small>
             <img src="{{asset('storage/'. $dish->img)}}" alt="{{$dish->name}}" width="200">
        </div>
          @error('img')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    {{--/Immagini--}}


    {{-- visibility --}}
    <div class="form-group">

        <select class="form-control" name="visibility" id="visibility" aria-describedby="visibilityId" required>
            <option value="{{$dish->visibility}}" selected>{{$dish->visibility ? 'Visibile' : 'Non visibile'}}</option>
            <option value="1">Visibile</option>
            <option value="0">Non visibile</option>
        </select>
        {{-- <small id="typeId" class="form-text text-muted pl-2">Add a type</small> --}}
    </div>
    @error('type')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- /visibility --}}


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @else
        <div class="alert alert-danger">{{Auth::user()->name}} non sei autorizzato alla modifica di questo piatto</div>
    @endif
</div>







@endsection





