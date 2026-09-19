@extends('admin.layouts.app')

@push('page-header')
<div class="col">
    <h3 class="page-title">My Profile</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ul>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-auto profile-image">
                    <a href="#">
                        <img class="rounded-circle" alt="User Image" style="width:72px;height:72px;object-fit:cover;border:3px solid var(--pf-border);" src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/img/avatar.png')}}">
                    </a>
                </div>
                <div class="col ml-md-n2 profile-user-info">
                    <h4 class="user-name mb-0">{{auth()->user()->name}}</h4>
                    <h6 class="text-muted" style="font-weight:400;font-size:13px;margin-top:4px;">{{auth()->user()->email}}</h6>
                    <div style="margin-top:6px;">
                        @foreach (auth()->user()->getRoleNames() as $role)
                        <span class="badge badge-primary">{{$role}}</span>
                        @endforeach
                    </div>
                </div>
                <div class="col-auto">
                    <a href="#edit_personal_details" data-toggle="modal" class="btn btn-primary btn-sm">
                        <i class="fe fe-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- Profile Tabs -->
        <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#per_details_tab">Personal Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#password_tab">Change Password</a>
                </li>
            </ul>
        </div>

        <div class="tab-content profile-tab-cont">

            <!-- Personal Details Tab -->
            <div class="tab-pane fade show active" id="per_details_tab">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title" style="margin:0;">Personal Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row" style="padding:8px 0;border-bottom:1px solid var(--pf-border-light);margin-bottom:12px;">
                                    <div class="col-sm-3" style="color:var(--pf-muted);font-size:13px;font-weight:500;">Full Name</div>
                                    <div class="col-sm-9" style="font-weight:500;">{{auth()->user()->name}}</div>
                                </div>
                                <div class="row" style="padding:8px 0;border-bottom:1px solid var(--pf-border-light);margin-bottom:12px;">
                                    <div class="col-sm-3" style="color:var(--pf-muted);font-size:13px;font-weight:500;">Email Address</div>
                                    <div class="col-sm-9">{{auth()->user()->email}}</div>
                                </div>
                                <div class="row" style="padding:8px 0;">
                                    <div class="col-sm-3" style="color:var(--pf-muted);font-size:13px;font-weight:500;">User Role</div>
                                    <div class="col-sm-9">
                                        @foreach (auth()->user()->getRoleNames() as $role)
                                        <span class="badge badge-primary">{{$role}}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Change Password Tab -->
            <div id="password_tab" class="tab-pane fade">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" style="margin:0;">Change Password</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 col-lg-6">
                                <form method="POST" action="{{route('update-password',auth()->user())}}">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label>Current Password <span class="text-danger">*</span></label>
                                        <input type="password" name="current_password" class="form-control" placeholder="Enter current password">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control" placeholder="Enter new password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                                    </div>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fe fe-lock"></i> Update Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Personal Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{route('profile.update',auth()->user())}}">
                    @csrf
                    <div class="form-group">
                        <label>Full Name <span class="text-danger">*</span></label>
                        <input class="form-control" name="name" type="text" value="{{auth()->user()->name}}" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                        <label>Email Address <span class="text-danger">*</span></label>
                        <input class="form-control" name="email" type="email" value="{{auth()->user()->email}}" placeholder="Email">
                    </div>
                    @can('edit-role')
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control select edit_role" name="role">
                            @foreach ($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endcan
                    <div class="form-group">
                        <label>Profile Picture</label>
                        <input type="file" value="{{auth()->user()->avatar}}" class="form-control" name="avatar" style="height:auto;padding:7px 12px;">
                    </div>
                    <div style="margin-top:16px;">
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection