@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-header')
<div class="col-sm-7 col-auto">
    <h3 class="page-title">Sales Reports</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Sales Reports</li>
    </ul>
</div>
<div class="col-sm-5 col">
    <a href="#generate_report" data-toggle="modal" class="btn btn-primary float-right mt-2">
        <i class="fe fe-filter"></i> Generate Report
    </a>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        @isset($sales)
            <!-- Sales Report Table -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fe fe-bar-chart-2" style="color:var(--pf-primary);"></i>
                        Sales Report Data
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    @if (!(empty($sale->product->purchase)))
                                        <tr>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:10px;">
                                                    @if (!empty($sale->product->purchase->image))
                                                        <span style="width:36px;height:36px;border-radius:8px;overflow:hidden;display:block;flex-shrink:0;background:var(--pf-bg);">
                                                            <img style="width:100%;height:100%;object-fit:cover;" src="{{asset('storage/purchases/'.$sale->product->purchase->image)}}" alt="image">
                                                        </span>
                                                    @endif
                                                    <span style="font-weight:500;">{{$sale->product->purchase->product}}</span>
                                                </div>
                                            </td>
                                            <td>{{$sale->quantity}}</td>
                                            <td>{{AppSettings::get('app_currency', '$')}} {{($sale->total_price)}}</td>
                                            <td>{{date_format(date_create($sale->created_at),"d M, Y")}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Sales Report Table -->
        @else
            <!-- Initial prompt state -->
            <div class="card">
                <div class="card-body">
                    <div class="pf-empty">
                        <div class="pf-empty-icon">
                            <i class="fe fe-bar-chart-2"></i>
                        </div>
                        <h5>No Report Generated Yet</h5>
                        <p>Click the "Generate Report" button above to filter and export sales data by date range.</p>
                        <div style="margin-top:16px;">
                            <a href="#generate_report" data-toggle="modal" class="btn btn-primary">
                                <i class="fe fe-filter"></i> Select Date Range
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
</div>

<!-- Generate Report Modal -->
<div class="modal fade" id="generate_report" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Sales Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('sales.report')}}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>From Date <span class="text-danger">*</span></label>
                                <input type="date" name="from_date" class="form-control from_date" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>To Date <span class="text-danger">*</span></label>
                                <input type="date" name="to_date" class="form-control to_date" required>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:10px;">
                        <button type="submit" class="btn btn-primary btn-block submit_report">
                            <i class="fe fe-file-text"></i> Generate Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Generate Report Modal -->
@endsection

@push('page-js')
<script>
    $(document).ready(function(){
        $('#sales-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                extend: 'collection',
                text: 'Export Data',
                buttons: [
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: "thead th:not(.action-btn)"
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: "thead th:not(.action-btn)"
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: "thead th:not(.action-btn)"
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: "thead th:not(.action-btn)"
                        }
                    }
                ]
                }
            ]
        });
    });
</script>
@endpush