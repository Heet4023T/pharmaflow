@props(['error'=>$error])

<div class="alert alert-dismissible mb-3" role="alert" style="background:var(--pf-danger-light);color:#991b1b;border:none;border-left:4px solid var(--pf-danger);border-radius:var(--pf-radius-lg);padding:12px 16px;display:flex;align-items:flex-start;gap:10px;font-size:13.5px;margin-bottom:12px;">
    <i class="fe fe-alert-circle" style="color:var(--pf-danger);font-size:16px;flex-shrink:0;margin-top:1px;"></i>
    <div style="flex:1;">{{$error}}</div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="background:none;border:none;cursor:pointer;color:#991b1b;opacity:0.6;padding:0;font-size:18px;line-height:1;margin-left:4px;">
        <span aria-hidden="true">&times;</span>
    </button>
</div>