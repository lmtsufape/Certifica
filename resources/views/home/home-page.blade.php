@extends('layouts.app')


@section('title','Home Page')


@section('content')

<section class="home-page-home">

    <div class="container d-flex align-items-center row">

        <div class=" col-6 home-page-welcome-text text-center">
            <div class="row align-items-center ">
            <p  >Lorem ipsum ahuisn  <img
                src="{{asset('images/home-page/logo-certifica.png')}}"
                width= "150"
                alt="">
            </p>

            <p>sed do eiusmod tempor.</p>
            </div>
            <img src="{{asset('images/home-page/pessoas-home-page.png')}}" alt="">

        </div>

        <div class="col-6">
            @include('layouts.components.home-page-form')
        </div>
    </div>

</section>



@endsection
