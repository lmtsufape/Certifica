@extends('layouts.app')


@section('title','Home Page')


@section('content')

<section class="home-page-home">

    <div class="container d-flex align-items-center row">

        <div class=" col-6 home-page-welcome-text">
            <p  >Lorem ipsum ahuisn  Certifica </p>
            <p>sed do eiusmod tempor.</p>
            <img src="{{asset('images/home-page/pessoas-home-page.png')}}" alt="">
        </div>
        <div class="col-6">
            @include('layouts.components.home-page-form')
        </div>
    </div>

</section>



@endsection
