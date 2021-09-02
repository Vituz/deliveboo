@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container p-2 justify-content-center">
        <div class="show-card col-md-10">
                <div class="card-top mb-3">
                    <!-- <img src="{{asset('storage/' . $dish->image)}}" alt="{{$dish->name}}"> -->
                    <h3>{{$dish->name}} </h3>
                    <img src="{{asset('storage/'. $dish->img)}}" alt="{{$dish->name}}" width="400">
                    <p>{{$dish->description}}</p>
                    <p>{{$dish->ingredients}}</p>
                    <span>{{$dish->price}} &euro;</span>
                </div>
                <div class="form-group d-flex ">
                    <a href="{{route('admin.dishes.edit', $dish->id)}}" class="btn btn-primary btn-sm mr-3">Modifica il tuo piatto</a>
                    <form action="{{route('admin.dishes.destroy', $dish->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            Elimina piatto
                        </button>
                    </form>
                </div>
                <a href="{{route('admin.dishes.index')}}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left fa-sm fa-fw"></i> Back</a>
        </div> 
    </div>
@endsection