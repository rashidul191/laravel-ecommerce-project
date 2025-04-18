@extends('layout.app')
@section('title', "Category Page")
@section('content')

@include('components.common.breadcrumb')

@include('components.category.by-category-list')

@endsection