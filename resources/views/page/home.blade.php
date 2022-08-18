@extends('layouts.master_home')
@include('layouts.body.slider')
@section('home_content')
    <!-- ======= About Us Section ======= -->
    @include('layouts.body.about')
    <!-- ======= Services Section ======= -->
    @include('layouts.body.services')
    <!-- ======= Portfolio Section ======= -->
    @include('layouts.body.photo')
    <!-- ======= Our Clients Section ======= -->
    @include('layouts.body.clients')
@endsection
