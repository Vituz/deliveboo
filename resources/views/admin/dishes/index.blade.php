@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1>Dishes table</h1>
        @foreach($dishes as $dish)
            {{$dish->name}}
        @endforeach
@endsection