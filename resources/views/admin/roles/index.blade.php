@extends('admin.layouts.app')

<x-assets.datatables />  

@push('page-header')
<div class="col-sm-7 col-auto">
    <h3 class="page-title">Roles</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Roles</li>
    </ul>
</div>
<div class="col-sm-5 col">
    <a href="{{route('roles.create')}}" class="btn btn-primary float-right mt-2">
        <i class="fe fe-plus"></i> Add Role
    </a>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-shield" style="color:var(--pf-primary);"></i>
                    User Roles
                </h4>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table id="role-table" class="datatable table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th class="text-center action-btn">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>			
</div>
@endsection

@push('page-js')
<script>
    $(document).ready(function() {
        var table = $('#role-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('roles.index')}}",
            columns: [
                {data: 'name', name: 'name'},
                {data: 'permissions', name: 'permissions'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endpush
