@extends('layout.app')
@section('title', "Category Page")
@section('content')

@include('components.common.breadcrumb')

@include('components.category.category-list')

@endsection