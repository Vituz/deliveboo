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

    .clicked {
        background-color: cornflowerblue;
    }
</style>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')

<div class="container">

    <!-- <input type="text" v-model="query" @keyup.enter="search(query)" placeholder="Search by category"> -->

    <div class="card-group d-flex justify-content-center">
        <button class="w-25  rounded m-3" :class="clicked_categories.includes(category.id)? 'clicked' : ''" v-for="category in categories" v-on:click="filter_restaurants(category.id)">
            <!-- <img class="card-img-top" :src="'storage/' + restaurant.image" :alt="restaurant.name"> -->
            <div class="p-2">
                <h4 class="card-title">@{{category.name}}</h4>
                <p class="card-text">@{{category.users.length}} </p>
            </div>
        </button>
    </div>

    <div class="card-group">

        <div class="card" v-for="restaurant in fill_restaurants">
            <img class="card-img-top" data-src="holder.js/100x180/" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">@{{restaurant.name}}</h4>
                <p class="card-text">@{{category}}</p>
            </div>
        </div>

    </div>

</div>

@endsection