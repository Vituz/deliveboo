@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrazione') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        

                        <div class="dati_personali">
                            <h2>Dati personali</h2>
                            <!-- email -->
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Indirizzo Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email@esempio.com">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <!-- /email -->

                            <!-- PASSW=RD -->
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <!-- PASSW=RD -->

                        </div>  
                        <hr> 
                        <div class="dati_ristorante">
                            <div>
                                <h2> Informazioni Ristorante</h2>
                                <!-- Nome ristorante -->
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Nome Attività</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Inserisci il nome della tua attività">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--/Nome ristorante -->

                                <!-- CATEGORIE -->
                                <div class="form-group row">
                                    <label for="categories[]" class="col-md-4 col-form-label text-md-right">Categoria</label>
                                    <div class="col-md-6">
                                        <select multiple class="form-control @error('categories') is-invalid @enderror" name="categories[]" id="categories[]">
                                            <option value="" disabled>Seleziona una o più categorie</option>
                                            @foreach($categories as $category )
                                                                                
                                            @if (old('categories'))
                                                <option value="{{$category->id}}" {{in_array($category->id, old('categories'))? 'selected': ''}}>{{$category->name}}</option>
                                                @else
                                                <option value="{{$category->id}}" >{{$category->name}}</option>
                                            @endif
                                            @endforeach
                                        
                                        </select>
                                        @error('categories')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- / CATEGORIE -->
                                <!-- CITTA' -->
                                <div class="form-group row">
                                    <label for="city" class="col-md-4 col-form-label text-md-right">Città</label>

                                    <div class="col-md-6">
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="Città" placeholder="Inserisci la località dell'attività">

                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- /CITTA' -->

                                <!-- INDIRIZZO -->
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Indirizzo</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="Città" placeholder="Via mario rossi, 13">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                                <!-- /INDIRIZZO -->
                                <!-- PARTITA IVA -->
                                <div class="form-group row">
                                    <label for="p_iva" class="col-md-4 col-form-label text-md-right">P.Iva</label>

                                    <div class="col-md-6">
                                        <input id="p_iva" type="text" class="form-control @error('p_iva') is-invalid @enderror" name="p_iva" value="{{ old('p_iva') }}" required autocomplete="p_iva" placeholder="Inserisci la tua partita IVA" minlength="11" maxlength="11">

                                        @error('p_iva')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- BOTTONE REGISTRAZIONE -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </div>
      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

