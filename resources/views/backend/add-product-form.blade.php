@extends('layout.app')
@section('content')

<section class="add-product-form-section">
    <div class="container">
        <form action="{{ route('product.create') }}" method="POST" class="row row-cols-3" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="productTitle">Product Title</label>
                <input type="text" class="form-control" id="productTitle" name="title" placeholder="Product Title">
            </div>
            <div class="form-group mb-3">
                <label for="short_des">Short Description</label>
                <input type="text" class="form-control" id="short_des" name="short_des" placeholder="Short Description">
            </div>
            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="500">
            </div>
            <div class="form-group mb-3">
                <label for="discount">Discount</label>
                <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" value="0">
            </div>
            <div class="form-group mb-3">
                <label for="discount_price">Discount Price</label>
                <input type="text" class="form-control" id="discount_price" name="discount_price" placeholder="Discount Price" value="0">
            </div>
            <div class="form-group mb-3">
                <label for="image">Image</label>
                <!-- <input type="text" class="form-control" id="image" name="image" placeholder="Image Url"> -->
                <input type="file" class="form-control" id="image" name="image" placeholder="Image Url">
            </div>
            <div class="form-group mb-3">
                <label for="stock">Stock</label>
                <input type="text" class="form-control" id="stock" name="stock" placeholder="Stock" value="1">
            </div>
            <div class="form-group mb-3">
                <label for="star">Star</label>
                <input type="text" class="form-control" id="star" name="star" placeholder="star" value="80">
            </div>
            <div class="form-group mb-3">
                <label for="remark">Remark</label>
                <input type="text" class="form-control" id="remark" name="remark" placeholder="remark" value="new">
            </div>
            <div class="form-group mb-3">
                <label for="category_id">Category ID</label>
                <input type="text" class="form-control" id="category_id" name="category_id" placeholder="remark" value="5">
            </div>
            <div class="form-group mb-3">
                <label for="brand_id">Brand ID</label>
                <input type="text" class="form-control" id="brand_id" name="brand_id" placeholder="remark" value="2">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
</section>

@endsection