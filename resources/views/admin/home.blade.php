@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Benvenuto {{ Auth::user()->name }} sulla tua Dashboard</p>
                    
                </div>
               
            </div>
            <div class="user_profile">
                    <h2 class="text-center">{{Auth::user()->name}}</h2>
                    @if (Auth::user()->image)
                        <img src="{{Auth::user()->image}}" width=100% alt="immagine profilo"> 
                        <form action="{{route('admin.changeImage',$user)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="file" name="image" id="image">
                            <button type="submit" class="btn btn-primary">CAMBIA IMMAGINE</button>
                        </form>                  
                   
                    @else 
                    <form action="{{route('admin.setImage')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" id="image">
                        <button type="submit" class="btn btn-danger">NUOVA IMMAGINE</button>
                    </form>
                    @endif
                    <div class="user_details d-flex flex-column">
                        <div class="localita d-flex justify-content-between">
                            <span> <strong>Città: </strong>{{Auth::user()->city}}</span>
                        <span><strong>Indirizzo: </strong>{{Auth::user()->address}}</span>
                        </div>
                        
                        <span class="w-100 text-center"> <strong>Partita IVA: </strong>{{Auth::user()->p_iva}}</span>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
