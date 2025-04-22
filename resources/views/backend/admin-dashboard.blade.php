@extends('layout.app')
@section('content')

<section class="admin-dashboard-section">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col">
                <ul>
                    <li>
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">Add Product</a>
                    </li>
                </ul>
            </div>
            <div class="col">

            </div>
        </div>
    </div>
</section>

@endsection