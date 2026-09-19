@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-header')
<div class="col-sm-7 col-auto">
    <h3 class="page-title">Sales</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Sales</li>
    </ul>
</div>
@can('create-sale')
<div class="col-sm-5 col">
    <a href="{{route('sales.create')}}" class="btn btn-primary float-right mt-2">
        <i class="fe fe-plus"></i> Add Sale
    </a>
</div>
@endcan
@endpush

@section('content')
<!-- Date Filter Card -->
<div class="row">
    <div class="col-12">
        <div class="card" style="margin-bottom: 20px;">
            <div class="card-body" style="padding: 16px 20px;">
                <div class="row align-items-center">
                    <div class="col-12 col-md-3" style="margin-bottom: 10px;">
                        <span style="font-size: 14px; font-weight: 600; color: var(--pf-text); display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-calendar-alt" style="color:var(--pf-primary);"></i>
                            Filter by Date Range
                        </span>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 10px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-size: 12px; font-weight: 500; background: var(--pf-bg);">From</span>
                            </div>
                            <input type="date" id="filter_from_date" class="form-control" style="height: 38px; font-size: 13px;">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3" style="margin-bottom: 10px;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-size: 12px; font-weight: 500; background: var(--pf-bg);">To</span>
                            </div>
                            <input type="date" id="filter_to_date" class="form-control" style="height: 38px; font-size: 13px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-3" style="margin-bottom: 10px; display: flex; gap: 8px;">
                        <button type="button" id="btn_apply_filter" class="btn btn-primary" style="padding: 8px 16px; font-size: 13px; font-weight: 550; display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fe fe-filter"></i> Apply
                        </button>
                        <button type="button" id="btn_reset_filter" class="btn btn-secondary" style="padding: 8px 14px; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fe fe-refresh-cw"></i> Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sales Transactions Table -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fas fa-receipt" style="color:var(--pf-primary); margin-right: 6px;"></i>
                    Sales Transactions
                </h4>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table id="sales-table" class="datatable table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Date</th>
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
        var table = $('#sales-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('sales.index')}}",
                data: function(d) {
                    d.from_date = $('#filter_from_date').val();
                    d.to_date = $('#filter_to_date').val();
                }
            },
            columns: [
                {data: 'product', name: 'product'},
                {data: 'quantity', name: 'quantity'},
                {data: 'total_price', name: 'total_price'},
                {data: 'date', name: 'date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#btn_apply_filter').on('click', function() {
            table.draw();
        });

        $('#btn_reset_filter').on('click', function() {
            $('#filter_from_date').val('');
            $('#filter_to_date').val('');
            table.draw();
        });

        // Also allow pressing enter inside date inputs to trigger filter
        $('#filter_from_date, #filter_to_date').on('change', function() {
            table.draw();
        });
    });
</script>
@endpush