@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Add Product</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
        <li class="breadcrumb-item active">Add Product</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-plus-circle" style="color:var(--pf-primary);"></i>
                    New Product
                </h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" id="update_service" action="{{route('products.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Select Purchase / Medicine <span class="text-danger">*</span></label>
                                <select class="select2 form-select form-control" name="product">
                                    @foreach ($purchases as $purchase)
                                        <option value="{{$purchase->id}}">{{$purchase->product}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Selling Price <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="price" value="{{old('price')}}" placeholder="e.g. 12.50">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Discount (%) <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="discount" value="0" placeholder="e.g. 5">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Optional product description">{{old('description')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary" type="submit" name="form_submit" value="submit">
                            <i class="fe fe-save"></i> Save Product
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