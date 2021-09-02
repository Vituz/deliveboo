@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
                <div class="user_profile">
                    <h2 class="text-center"> Benvenuto {{Auth::user()->name}}</h2>
                    <hr>
                    @if (Auth::user()->image)
                        <img src="{{asset('storage/' . Auth::user()->image)}}" width="100%" alt="immagine profilo"> 
                        <form class="d-flex flex-column mt-3" action="{{route('admin.changeImage',$user)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="file" name="image" id="image" class="justify-content-center">
                            <button type="submit" class="btn btn-primary mt-3">CAMBIA IMMAGINE</button>
                        </form>                  
                   
                    @else 
                        <form class="d-flex flex-column mt-3" action="{{route('admin.setImage')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" id="image">
                            <button type="submit" class="btn btn-danger">NUOVA IMMAGINE</button>
                        </form>
                    @endif
                        <div class="user_details d-flex flex-column mt-3">
                            <div class="localita d-flex flex-column">
                                <span><strong>Città: </strong>{{Auth::user()->city}}</span>
                                <span><strong>Indirizzo: </strong>{{Auth::user()->address}}</span>
                            </div>
                            
                            <span class="w-100"> <strong>Partita IVA: </strong>{{Auth::user()->p_iva}}</span>
                        </div>
                </div>
        </div>
    </div>
</div>
@endsection
