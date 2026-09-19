<!-- Add Sale Modal -->
<div class="modal fade" id="add_sales" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fe fe-shopping-bag" style="color:var(--pf-primary);margin-right:8px;"></i>
                    Sell Product
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('sales.store')}}">
                    @csrf
                    <div class="form-group">
                        <label>Product <span class="text-danger">*</span></label>
                        <select class="select2 form-select form-control" name="product">
                            @foreach (\App\Models\Product::get() as $product)
                                @if (!empty($product->purchase))
                                    @if (!($product->purchase->quantity <= 0))
                                        <option value="{{$product->id}}">{{$product->purchase->product}}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity <span class="text-danger">*</span></label>
                        <input type="number" value="1" class="form-control" name="quantity" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Sale Date <span class="text-danger">*</span></label>
                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="date" required>
                    </div>
                    <div style="margin-top:20px;">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fe fe-check"></i> Confirm Sale
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Sale Modal -->