@extends('layout.app')
@section('title', "Rashidul Shop - eCommerce Website")
@section('content')


@include('components.home.hero-slider')
@include('components.home.top-categories')
@include('components.home.exclusive-products')
@include('components.home.single-banner')
@include('components.home.featured-products')
@include('components.home.testimonial')
@include('components.home.top-brands')


@endsection