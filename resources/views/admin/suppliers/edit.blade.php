@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Edit Supplier</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('suppliers.index')}}">Suppliers</a></li>
        <li class="breadcrumb-item active">Edit Supplier</li>
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
                    Update Supplier Information
                </h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('suppliers.update',$supplier)}}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="{{$supplier->name ?? old('name')}}" name="name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" value="{{$supplier->email ?? old('email')}}" name="email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="{{$supplier->phone ?? old('phone')}}" name="phone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="{{$supplier->company ?? old('company')}}" name="company">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" value="{{$supplier->address ?? old('address')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Product</label>
                                <input type="text" name="product" value="{{$supplier->product ?? old('product')}}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Comment / Notes</label>
                                <textarea name="comment" class="form-control" rows="4">{{$supplier->comment ?? old('comment')}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary" type="submit" name="form_submit" value="submit">
                            <i class="fe fe-save"></i> Update Supplier
                        </button>
                        <a href="{{route('suppliers.index')}}" class="btn btn-secondary" style="margin-left:8px;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
