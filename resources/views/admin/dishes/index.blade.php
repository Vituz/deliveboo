@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1>Dishes table</h1>

<div class="col-md-10 p-2">
    <table class="table table-striped table-inverse ">
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>IMAGE</th>
                <th>NAME</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>

            @foreach($dishes as $dish)

            <tr>
                <td scope="row">{{$dish->id}}</td>
                <td>
                    <img src="{{asset('storage/' . $dish->img)}}" width="200" height="150" alt="">
                </td>
                <td>
                    {{$dish->name}}
                </td>
                <td class="d-flex ">
                    <a href="{{route('admin.dishes.show', $dish->id )}}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye fa-sm fa-fw"></i> View
                    </a>
                    <a href="{{route('admin.dishes.edit', $dish->id )}}" class="btn btn-secondary btn-sm mx-3">
                        <i class="fas fa-pencil-alt fa-sm fa-fw"></i> Edit
                    </a>


                    <form action="{{route('admin.dishes.destroy', $dish->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want really delete this dish?') ">
                            <i class="fas fa-trash"></i> Delete
                        </button>

                    </form>

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
    
    <a href="{{route('admin.dishes.create')}}" class="btn btn-primary">Add New Dish</a>
</div>

@endsection