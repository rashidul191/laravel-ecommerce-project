@extends('layout.app')
@section('content')
@include('components.common.menu-bar')

@include('components.home.hero-slider')
@include('components.home.top-categories')
@include('components.home.exclusive-products')
@include('components.home.single-banner')
@include('components.home.featured-products')
@include('components.home.testimonial')
@include('components.home.top-brands')

@include('components.common.footer')
@endsection