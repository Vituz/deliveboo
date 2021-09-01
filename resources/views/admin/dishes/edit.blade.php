@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Edit single dish</h1>

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
    <h1>Add single dish</h1>

    @section('content')

   
    <form action="{{ route('admin.dishes.store') }}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="form-group">
            <div class="sub d-flex justify-content-center align-items-center">
                <span class="mr-4">User_ID</span>
                <input type="text" readonly class="form-control" name="user_id" id="user_id"  value=" {{ Auth::user()->id }}" >
            </div>
        </div>



        <div class="form-group">
            <input type="text" class="form-control @error('name') is invalid @enderror" name="name" id="name"
                aria-describedby="nameId" placeholder="Dish" minlength="5" max="50" value="{{ $dish->name}}"
                max=50 required>
            <small id="nameId" class="form-text text-muted pl-2">Add a name</small>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- Type --}}
        <div class="form-group">

            <select class="form-control" name="type" id="type" aria-describedby="typeId">
                <option value="" selected disabled>Select the dish type</option>
                <option value="starters">Starters</option>
                <option value="first courses">First courses</option>
                <option value="main courses">Main courses</option>
                <option value="side courses">Side dishes</option>
                <option value="desserts">Desserts</option>
                <option value="drinks">Drinks</option>
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
            value="" >{{$dish->ingredients }}</textarea>
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
                  <span class="input-group-text">$</span>
                  <span class="input-group-text">0.00</span>
                </div>
                <input type="text" class="form-control" name="price"  id="price" value="{{$dish->price}}" required>
              </div>          

        @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>
        
        {{-- /price  --}}
   
    {{--Immagini--}}
        <div class="form-group">
            <input type="file" class="form-control-file @error('img') is invalid @enderror" name="img"
                id="img" aria-describedby="imgId"
                value="{{$dish->img }}" max="300" required>
            <small id="imgId" class="form-text text-muted">Place an Url image</small>
        </div>
          @error('img')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    {{--/Immagini--}}


    {{-- visibility --}}
    <div class="form-group">

        <select class="form-control" name="visibility" id="visibility" aria-describedby="visibilityId" required>
            <option value="" selected disabled>The dish will be visible?</option>
            <option value="1">true</option>
            <option value="0">false</option>
        </select>
        {{-- <small id="typeId" class="form-text text-muted pl-2">Add a type</small> --}}
    </div>
    @error('type')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    {{-- /visibility --}}


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>







@endsection





