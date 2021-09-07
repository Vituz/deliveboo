@extends('layouts.admin')

@section('content')

<h1>Lista ordini</h1>

<div class="col-md-10 p-2">
    <table class="table table-striped table-inverse ">
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Indirizzo</th>
                <th>Prezzo</th>
                <th>Ordine del</th>
            </tr>
        </thead>
        <tbody>

            @foreach($orders as $order)

            <tr>
                <td scope="row">
                    {{$order->id}}
                </td>
                <td>
                    {{$order->ui_name}}
                </td>
                
                <td>
                    {{$order->ui_surname}}
                </td>
                <td>
                    {{$order->ui_address}}
                </td>
                <td>
                    {{$order->amount}}
                </td>
                <td>
                    {{$order->created_at}}
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

@endsection