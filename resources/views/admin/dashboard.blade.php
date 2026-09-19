@extends('admin.layouts.app')

<x-assets.datatables />

@push('page-css')
    <link rel="stylesheet" href="{{asset('assets/plugins/chart.js/Chart.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Dashboard</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item active">Welcome back, {{auth()->user()->name}}</li>
    </ul>
</div>
@endpush

@section('content')

<!-- KPI Stats Row with Distinct Pharmacy Visuals -->
<div class="row">
    <!-- Card 1: Today's Sales -->
    <div class="col-xl-3 col-sm-6 col-12 mb-3">
        <div class="card" style="border-left: 3px solid var(--pf-primary);">
            <div class="card-body">
                <div class="dash-widget-header" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div class="dash-widget-icon text-primary">
                        <!-- Medicine Package + Sales Receipt Visual -->
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Bottle Body -->
                            <rect x="5" y="7" width="13" height="19" rx="3" fill="#f0fce8" stroke="#3eb800" stroke-width="2"/>
                            <!-- Bottle Cap -->
                            <rect x="8.5" y="3.5" width="6" height="3.5" rx="1" fill="#3eb800"/>
                            <line x1="7" y1="12" x2="16" y2="12" stroke="#3eb800" stroke-width="1.5" stroke-dasharray="2 2"/>
                            <!-- Medical Cross on Bottle -->
                            <path d="M11.5 15V21M8.5 18H14.5" stroke="#3eb800" stroke-width="2" stroke-linecap="round"/>
                            <!-- Sales Receipt on Right -->
                            <path d="M18 9H27V26L24.5 24.5L22.5 26L20.5 24.5L18 26V9Z" fill="#ffffff" stroke="#0d7490" stroke-width="1.6" stroke-linejoin="round"/>
                            <!-- Currency / Receipt lines -->
                            <line x1="20.5" y1="13" x2="24.5" y2="13" stroke="#0d7490" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="20.5" y1="16.5" x2="24.5" y2="16.5" stroke="#0d7490" stroke-width="1.5" stroke-linecap="round"/>
                            <circle cx="22.5" cy="20.5" r="1.5" fill="#16a34a"/>
                        </svg>
                    </div>
                    <div class="dash-count" style="text-align:right;">
                        <h3 style="font-size:24px; font-weight:700; color:var(--pf-text); margin:0; letter-spacing:-0.5px;">{{AppSettings::get('app_currency', '$')}}{{$today_sales}}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted" style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 6px;">Today&apos;s Sales</h6>
                    <div class="progress" style="height:5px; background:var(--pf-border); border-radius:4px;">
                        <div class="progress-bar bg-primary" style="width:65%; border-radius:4px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Product Categories -->
    <div class="col-xl-3 col-sm-6 col-12 mb-3">
        <div class="card" style="border-left: 3px solid var(--pf-success);">
            <div class="card-body">
                <div class="dash-widget-header" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div class="dash-widget-icon text-success">
                        <!-- Multiple Medicine Categories / Blister Pack + Capsule Visual -->
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Blister Pack in background -->
                            <rect x="4" y="5" width="16" height="22" rx="3" fill="#dcfce7" stroke="#16a34a" stroke-width="1.8"/>
                            <circle cx="8.5" cy="10" r="2" fill="#16a34a"/>
                            <circle cx="15.5" cy="10" r="2" fill="#16a34a"/>
                            <circle cx="8.5" cy="16" r="2" fill="#16a34a"/>
                            <circle cx="15.5" cy="16" r="2" fill="#16a34a"/>
                            <circle cx="8.5" cy="22" r="2" fill="#16a34a"/>
                            <circle cx="15.5" cy="22" r="2" fill="#16a34a"/>
                            <!-- Angled Medicine Capsule in Foreground -->
                            <g transform="translate(14, 6) rotate(30)">
                                <rect x="0" y="0" width="8" height="16" rx="4" fill="#ffffff" stroke="#15803d" stroke-width="1.8"/>
                                <path d="M0 4C0 1.79086 1.79086 0 4 0C6.20914 0 8 1.79086 8 4V8H0V4Z" fill="#16a34a"/>
                                <line x1="0" y1="8" x2="8" y2="8" stroke="#15803d" stroke-width="1.5"/>
                            </g>
                        </svg>
                    </div>
                    <div class="dash-count" style="text-align:right;">
                        <h3 style="font-size:24px; font-weight:700; color:var(--pf-text); margin:0; letter-spacing:-0.5px;">{{$total_categories}}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted" style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 6px;">Product Categories</h6>
                    <div class="progress" style="height:5px; background:var(--pf-border); border-radius:4px;">
                        <div class="progress-bar bg-success" style="width:75%; border-radius:4px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Expired Products -->
    <div class="col-xl-3 col-sm-6 col-12 mb-3">
        <div class="card" style="border-left: 3px solid var(--pf-danger);">
            <div class="card-body">
                <div class="dash-widget-header" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div class="dash-widget-icon text-danger">
                        <!-- Medicine Bottle + Expiry Calendar Warning Visual -->
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Medicine Bottle -->
                            <rect x="5" y="8" width="13" height="18" rx="2.5" fill="#fee2e2" stroke="#dc2626" stroke-width="1.8"/>
                            <rect x="8.5" y="4" width="6" height="4" rx="1" fill="#dc2626"/>
                            <line x1="8" y1="13" x2="15" y2="13" stroke="#dc2626" stroke-width="1.5"/>
                            <path d="M11.5 16V20M9.5 18H13.5" stroke="#dc2626" stroke-width="1.5" stroke-linecap="round"/>
                            <!-- Expiry Calendar Sheet / Warning Emblem -->
                            <g transform="translate(15, 11)">
                                <rect x="0" y="2" width="13" height="14" rx="2" fill="#ffffff" stroke="#b91c1c" stroke-width="1.6"/>
                                <path d="M0 6H13" stroke="#b91c1c" stroke-width="1.5"/>
                                <line x1="3" y1="0.5" x2="3" y2="3.5" stroke="#b91c1c" stroke-width="1.5" stroke-linecap="round"/>
                                <line x1="10" y1="0.5" x2="10" y2="3.5" stroke="#b91c1c" stroke-width="1.5" stroke-linecap="round"/>
                                <!-- Warning exclamation inside calendar -->
                                <path d="M6.5 8.5V11.5" stroke="#dc2626" stroke-width="1.5" stroke-linecap="round"/>
                                <circle cx="6.5" cy="13.5" r="0.75" fill="#dc2626"/>
                            </g>
                        </svg>
                    </div>
                    <div class="dash-count" style="text-align:right;">
                        <h3 style="font-size:24px; font-weight:700; color:var(--pf-text); margin:0; letter-spacing:-0.5px;">{{$total_expired_products}}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted" style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 6px;">Expired Products</h6>
                    <div class="progress" style="height:5px; background:var(--pf-border); border-radius:4px;">
                        <div class="progress-bar bg-danger" style="width:{{$total_expired_products > 0 ? '50%' : '15%'}}; border-radius:4px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: System Users -->
    <div class="col-xl-3 col-sm-6 col-12 mb-3">
        <div class="card" style="border-left: 3px solid #6366f1;">
            <div class="card-body">
                <div class="dash-widget-header" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div class="dash-widget-icon text-warning">
                        <!-- Pharmacist & Pharmacy Staff Team Visual -->
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Secondary User Silhouette (Background Team) -->
                            <circle cx="21" cy="9" r="3.5" fill="#c7d2fe" stroke="#6366f1" stroke-width="1.4"/>
                            <path d="M17 23C17 19.5 19 17 23 17C26 17 28 19 28 23" stroke="#6366f1" stroke-width="1.4" stroke-linecap="round"/>
                            <!-- Primary Pharmacist / Medical Staff (Foreground) -->
                            <circle cx="12" cy="8" r="4.5" fill="#ffffff" stroke="#4338ca" stroke-width="1.8"/>
                            <!-- Coat Body -->
                            <path d="M4 25C4 19.5 7.5 16 12 16C16.5 16 20 19.5 20 25" fill="#ffffff" stroke="#4338ca" stroke-width="1.8" stroke-linecap="round"/>
                            <!-- Medical Badge Cross on Chest -->
                            <rect x="9.5" y="19" width="5" height="5" rx="1" fill="#6366f1"/>
                            <path d="M12 20.2V22.8M10.7 21.5H13.3" stroke="#ffffff" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="dash-count" style="text-align:right;">
                        <h3 style="font-size:24px; font-weight:700; color:var(--pf-text); margin:0; letter-spacing:-0.5px;">{{\DB::table('users')->count()}}</h3>
                    </div>
                </div>
                <div class="dash-widget-info">
                    <h6 class="text-muted" style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.05em; margin:0 0 6px;">System Users</h6>
                    <div class="progress" style="height:5px; background:var(--pf-border); border-radius:4px;">
                        <div class="progress-bar" style="width:50%; background:#6366f1; border-radius:4px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts + Tables Row -->
<div class="row">
    <!-- Today's Sales Table -->
    <div class="col-md-12 col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-shopping-bag" style="color:var(--pf-primary);"></i>
                    Today&apos;s Sales
                </h4>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table id="sales-table" class="datatable table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Medicine</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Resources Chart -->
    <div class="col-md-12 col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-pie-chart" style="color:var(--pf-primary);"></i>
                    Inventory Overview
                </h4>
            </div>
            <div class="card-body">
                {!! $pieChart->render() !!}
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
            ajax: "{{route('sales.index')}}",
            columns: [
                {data: 'product', name: 'product'},
                {data: 'quantity', name: 'quantity'},
                {data: 'total_price', name: 'total_price'},
                {data: 'date', name: 'date'},
            ]
        });
    });
</script>
<script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
@endpush