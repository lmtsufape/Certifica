@extends('layouts.main')


@section('title','Home Page')


@section('content')

<section class="home-page-home">

    <div class="home-page-welcome-text">
        <p  >Lorem ipsum ahuisn  Certifica </p>
        <p>sed do eiusmod tempor.</p>
        <img src="{{asset('images/home-page/pessoas-home-page.png')}}" alt="">
    </div>

    @include('layouts.components.home-page-form')


</section>



@endsection
