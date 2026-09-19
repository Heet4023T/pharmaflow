@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-header')
<div class="col-sm-7 col-auto">
    <h3 class="page-title">Suppliers</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Suppliers</li>
    </ul>
</div>
<div class="col-sm-5 col">
    @can('create-supplier')
    <a href="{{route('suppliers.create')}}" class="btn btn-primary float-right mt-2">
        <i class="fe fe-plus"></i> Add Supplier
    </a>
    @endcan
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-truck" style="color:var(--pf-primary);"></i>
                    Supplier Directory
                </h4>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table id="supplier-table" class="datatable table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Company</th>
                                <th class="action-btn">Action</th>
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
        var table = $('#supplier-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('suppliers.index')}}",
            columns: [
                {data: 'product', name: 'product'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'address', name: 'address'},
                {data: 'company',name: 'company'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush