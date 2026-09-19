@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Add Sale</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('sales.index')}}">Sales</a></li>
        <li class="breadcrumb-item active">Add Sale</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="width: 100%;">
            <div class="card-header" style="background: transparent; border-bottom: 1px solid var(--pf-border); padding: 16px 24px;">
                <h4 class="card-title" style="font-size: 15px; font-weight: 600; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i class="fe fe-shopping-cart" style="color:var(--pf-primary); font-size: 17px;"></i>
                    Record New Sale
                </h4>
            </div>
            <div class="card-body" style="padding: 24px;">
                <form method="POST" action="{{route('sales.store')}}">
                    @csrf
                    
                    <div class="row">
                        <!-- Product Selection -->
                        <div class="col-12 col-md-6">
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label style="font-size: 13px; font-weight: 600; color: var(--pf-text); margin-bottom: 6px; display: block;">
                                    Select Product / Medicine <span class="text-danger">*</span>
                                </label>
                                <select class="select2 form-select form-control" name="product" required style="width: 100%;">
                                    <option disabled selected value="">Select a medicine from inventory...</option>
                                    @foreach ($products as $product)
                                        @if (!empty($product->purchase))
                                            @if (!($product->purchase->quantity <= 0))
                                                <option value="{{$product->id}}">
                                                    {{$product->purchase->product}} — Available Stock: {{$product->purchase->quantity}} | Unit Price: {{AppSettings::get('app_currency', '$')}}{{$product->price}}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label style="font-size: 13px; font-weight: 600; color: var(--pf-text); margin-bottom: 6px; display: block;">
                                    Quantity <span class="text-danger">*</span>
                                </label>
                                <input type="number" value="1" min="1" class="form-control" name="quantity" placeholder="1" required style="height: 42px;">
                            </div>
                        </div>

                        <!-- Sale Date -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label style="font-size: 13px; font-weight: 600; color: var(--pf-text); margin-bottom: 6px; display: block;">
                                    Sale Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="date" required style="height: 42px;">
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Actions Divider & Buttons -->
                    <div class="submit-section" style="border-top: 1px solid var(--pf-border-light); margin-top: 6px; padding-top: 18px; display: flex; align-items: center; gap: 10px;">
                        <button type="submit" class="btn btn-primary" style="padding: 9px 24px; font-weight: 550;">
                            <i class="fe fe-check" style="margin-right: 4px;"></i> Complete Sale
                        </button>
                        <a href="{{route('sales.index')}}" class="btn btn-secondary" style="padding: 9px 20px;">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection