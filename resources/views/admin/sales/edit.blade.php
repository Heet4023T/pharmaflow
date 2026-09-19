@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Edit Sale</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('sales.index')}}">Sales</a></li>
        <li class="breadcrumb-item active">Edit Sale</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card" style="width: 100%;">
            <div class="card-header" style="background: transparent; border-bottom: 1px solid var(--pf-border); padding: 16px 24px;">
                <h4 class="card-title" style="font-size: 15px; font-weight: 600; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i class="fe fe-edit" style="color:var(--pf-primary); font-size: 17px;"></i>
                    Update Sale Record
                </h4>
            </div>
            <div class="card-body" style="padding: 24px;">
                <form method="POST" action="{{route('sales.update',$sale)}}">
                    @csrf
                    @method("PUT")
                    
                    <div class="row">
                        <!-- Product Selection -->
                        <div class="col-12 col-md-6">
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label style="font-size: 13px; font-weight: 600; color: var(--pf-text); margin-bottom: 6px; display: block;">
                                    Select Product / Medicine <span class="text-danger">*</span>
                                </label>
                                <select class="select2 form-select form-control edit_product" name="product" required style="width: 100%;">
                                    @foreach ($products as $product)
                                        @if (!empty($product->purchase))
                                            @if (!($product->purchase->quantity <= 0))
                                                <option {{($product->purchase->id == $sale->product->purchase_id) ? 'selected': ''}} value="{{$product->id}}">
                                                    {{$product->purchase->product}}
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
                                <input type="number" min="1" class="form-control edit_quantity" value="{{$sale->quantity ?? '1'}}" name="quantity" required style="height: 42px;">
                            </div>
                        </div>

                        <!-- Sale Date -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label style="font-size: 13px; font-weight: 600; color: var(--pf-text); margin-bottom: 6px; display: block;">
                                    Sale Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" value="{{ date('Y-m-d', strtotime($sale->created_at)) }}" class="form-control" name="date" required style="height: 42px;">
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Actions Divider & Buttons -->
                    <div class="submit-section" style="border-top: 1px solid var(--pf-border-light); margin-top: 6px; padding-top: 18px; display: flex; align-items: center; gap: 10px;">
                        <button type="submit" class="btn btn-primary" style="padding: 9px 24px; font-weight: 550;">
                            <i class="fe fe-save" style="margin-right: 4px;"></i> Save Changes
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