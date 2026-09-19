@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Edit Role</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
        <li class="breadcrumb-item active">Edit Role</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-shield" style="color:var(--pf-primary);"></i>
                    Update Role Permissions
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('roles.update',$role)}}">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label>Role Name <span class="text-danger">*</span></label>
                        <input type="text" name="role" value="{{$role->name}}" class="form-control" placeholder="Role name">
                    </div>
                    <div class="form-group">
                        <label>Select Permissions</label>
                        <select class="select2 form-select form-control" name="permission[]" multiple="multiple"> 
                            @foreach ($permissions as $permission)
                                <option @if($role->hasPermissionTo($permission->name)) selected @endif value="{{$permission->name}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="submit-section" style="padding-top:8px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fe fe-save"></i> Save Changes
                        </button>
                        <a href="{{route('roles.index')}}" class="btn btn-secondary" style="margin-left:8px;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection