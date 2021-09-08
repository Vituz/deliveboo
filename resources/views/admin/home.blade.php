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
                        
                            
                            <button class="btn btn-primary mt-3" type="button" data-toggle="modal" data-target="#Modal-changeImg">CAMBIA IMMAGINE</button>
                        
                        <div class="modal fade" id="Modal-changeImg" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> ATTENZIONE!!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> 
                                    <form class="d-flex flex-column mt-3" action="{{route('admin.changeImage',$user)}}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <input type="file" name="image" id="image" class="justify-content-center">
                                            <img width=100% src="{{asset('storage/' . Auth::user()->image)}}" alt="user image">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                                            
                                            <button type="submit" class="btn btn-primary ">CAMBIA IMMAGINE</button>                                     
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                 
                   
                    @else 
                    <button class="btn btn-primary mt-3" type="button" data-toggle="modal" data-target="#Modal-setImg">CARICA IMMAGINE</button>
                        
                        <div class="modal fade" id="Modal-setImg" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> WARNING!!</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> 
                                    <form class="d-flex flex-column mt-3" action="{{route('admin.setImage',$user)}}" method="POST" enctype="multipart/form-data">
                                       
                                        @csrf
                                        <div class="modal-body">
                                            <input type="file" name="image" id="image" class="justify-content-center">

                                            <img width=100% src="{{asset('storage/' . Auth::user()->image)}}" >
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                                           
                                            <button type="submit" class="btn btn-primary">CARICA</button>                                     
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

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
