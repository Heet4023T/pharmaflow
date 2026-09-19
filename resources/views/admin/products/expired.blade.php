@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Expired Products</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
        <li class="breadcrumb-item active">Expired</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-alert-triangle" style="color:var(--pf-danger);"></i>
                    Expired Medicines
                </h4>
                <span class="badge badge-danger">Requires Attention</span>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table id="expired-product" class="datatable table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Brand Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Expire Date</th>
                                <th class="action-btn">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-js')
<script>
    $(document).ready(function() {
        var table = $('#expired-product').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('expired')}}",
            columns: [
                {data: 'product', name: 'product'},
                {data: 'category', name: 'category'},
                {data: 'price', name: 'price'},
                {data: 'quantity', name: 'quantity'},
                {data: 'discount', name: 'discount'},
                {data: 'expiry_date', name: 'expiry_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush