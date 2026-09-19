@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Edit Product</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
        <li class="breadcrumb-item active">Edit Product</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-edit" style="color:var(--pf-primary);"></i>
                    Edit Product
                </h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="update_service" action="{{route('products.update',$product)}}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Product <span class="text-danger">*</span></label>
                                <select class="select2 form-select form-control" name="product">
                                    @foreach ($purchases as $purchase)
                                        @if(!empty($product->purchase))
                                        <option {{($product->purchase->id == $purchase->id) ? 'selected': ''}} value="{{$purchase->id}}">{{$purchase->product}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Selling Price <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="price" value="{{$product->price}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Discount (%) <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="discount" value="{{$product->discount}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3">{{$product->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary" type="submit" name="form_submit" value="submit">
                            <i class="fe fe-save"></i> Update Product
                        </button>
                        <a href="{{route('products.index')}}" class="btn btn-secondary" style="margin-left:8px;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-js')
@endpush