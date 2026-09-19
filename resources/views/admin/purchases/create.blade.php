@extends('admin.layouts.app')

@push('page-css')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Add Purchase</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('purchases.index')}}">Purchases</a></li>
        <li class="breadcrumb-item active">Add Purchase</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-shopping-cart" style="color:var(--pf-primary);"></i>
                    New Purchase Entry
                </h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" autocomplete="off" action="{{route('purchases.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Medicine Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="product" placeholder="e.g. Amoxicillin 500mg">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Category <span class="text-danger">*</span></label>
                                <select class="select2 form-select form-control" name="category">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Supplier <span class="text-danger">*</span></label>
                                <select class="select2 form-select form-control" name="supplier">
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Cost Price <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="cost_price" placeholder="e.g. 8.00">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Quantity <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="quantity" placeholder="e.g. 100">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Expiry Date <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" name="expiry_date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Medicine Image</label>
                                <input type="file" name="image" class="form-control" style="height:auto;padding:7px 12px;">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary" type="submit">
                            <i class="fe fe-save"></i> Save Purchase
                        </button>
                        <a href="{{route('purchases.index')}}" class="btn btn-secondary" style="margin-left:8px;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-js')
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
@endpush
