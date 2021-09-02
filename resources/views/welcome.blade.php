@extends('layouts.app')

<!-- Styles -->
<style>
    html,
    body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links>a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')

<div class="container">

    <div class="card-group d-flex">
        <div class="w-25" v-for="restaurant in restaurants">
            <img class="card-img-top" :src="'storage/' + restaurant.image" :alt="restaurant.name">
            <div class="card-body">
                <h4 class="card-title">@{{restaurant.name}}</h4>
                <p class="card-text">2</p>
            </div>
        </div>
    </div>

</div>


    </div>
    
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

@endsection