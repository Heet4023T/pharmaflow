@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Add Supplier</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('suppliers.index')}}">Suppliers</a></li>
        <li class="breadcrumb-item active">Add Supplier</li>
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
                    New Supplier Information
                </h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{route('suppliers.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="e.g. John Smith">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}" placeholder="supplier@example.com">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Phone <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone" value="{{old('phone')}}" placeholder="+1 (555) 000-0000">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Company <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="company" value="{{old('company')}}" placeholder="e.g. MedSupply Co.">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" class="form-control" value="{{old('address')}}" placeholder="Street, City, Country">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Product</label>
                                <input type="text" name="product" class="form-control" value="{{old('product')}}" placeholder="Primary medicine supplied">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Comment / Notes</label>
                                <textarea name="comment" class="form-control" rows="4" placeholder="Additional details or terms">{{old('comment')}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="submit-section">
                        <button class="btn btn-primary" type="submit" name="form_submit" value="submit">
                            <i class="fe fe-save"></i> Save Supplier
                        </button>
                        <a href="{{route('suppliers.index')}}" class="btn btn-secondary" style="margin-left:8px;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
