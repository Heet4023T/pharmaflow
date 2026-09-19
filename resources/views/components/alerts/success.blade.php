@props(['message'=>''])

<div class="alert alert-dismissible mb-3" role="alert" style="background:var(--pf-success-light);color:#166534;border:none;border-left:4px solid var(--pf-success);border-radius:var(--pf-radius-lg);padding:12px 16px;display:flex;align-items:flex-start;gap:10px;font-size:13.5px;margin-bottom:12px;">
    <i class="fe fe-check-circle" style="color:var(--pf-success);font-size:16px;flex-shrink:0;margin-top:1px;"></i>
    <div style="flex:1;">{{$message ?? $slot}}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background:none;border:none;cursor:pointer;color:#166534;opacity:0.6;padding:0;font-size:18px;line-height:1;margin-left:4px;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>