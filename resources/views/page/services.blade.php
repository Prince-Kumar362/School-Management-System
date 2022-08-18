@extends('layouts.master_home')
@section('home_content')
   <!-- ======= Breadcrumbs ======= -->
   <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>Service</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>Service</li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs -->
    <!-- ======= Services Section ======= -->
    @include('layouts.body.services')
   
@endsection
