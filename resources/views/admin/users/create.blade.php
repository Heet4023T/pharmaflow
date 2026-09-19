@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-12">
    <h3 class="page-title">Add User</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
        <li class="breadcrumb-item active">Add User</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-user-plus" style="color:var(--pf-primary);"></i>
                    Create New User
                </h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{route('users.store')}}">
                    @csrf
                    <div class="form-group">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="e.g. John Doe">
                    </div>
                    <div class="form-group">
                        <label>Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="user@pharmacy.com">
                    </div>
                    <div class="form-group">
                        <label>Role <span class="text-danger">*</span></label>
                        <select class="select2 form-select form-control" name="role">
                            @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Profile Picture</label>
                        <input type="file" name="avatar" class="form-control" style="height:auto;padding:7px 12px;">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="••••••••">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section" style="padding-top:8px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fe fe-save"></i> Create User
                        </button>
                        <a href="{{route('users.index')}}" class="btn btn-secondary" style="margin-left:8px;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection