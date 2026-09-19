@extends('admin.layouts.app')

@push('page-header')
<div class="col-sm-7 col-auto">
    <h3 class="page-title">Backups</h3>
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">System Backups</li>
    </ul>
</div>
<div class="col-sm-5 col">
    <form action="{{route('backup.store')}}" method="post" style="display:inline;">
        @csrf
        @method("PUT")
        <button class="btn btn-primary float-right mt-2" type="submit">
            <i class="fe fe-archive"></i> Create Backup
        </button>
    </form>
</div>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fe fe-archive" style="color:var(--pf-primary);"></i>
                    Database Backups
                </h4>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Storage Disk</th>
                                <th>Backup Date</th>
                                <th>File Size</th>
                                <th class="text-center action-btn">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($backups as $k => $b)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $b['disk'] }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}</td>
                                <td>{{ round((int)$b['file_size']/1048576, 2).' MB' }}</td>
                                <td class="text-center">
                                    <div class="actions" style="justify-content:center;">
                                        @if ($b['download'])
                                        <a href="{{ route('backup.download') }}?disk={{ $b['disk'] }}&path={{ urlencode($b['file_path']) }}&file_name={{ urlencode($b['file_name']) }}" class="btn btn-sm bg-success-light" title="Download Backup">
                                            <i class="fe fe-download"></i> Download
                                        </a>
                                        @endif
                                        <form action="{{route('backup.destroy',$b['file_name'])}}?disk={{ $b['disk'] }}" method="post" style="display:inline;">
                                            @csrf
                                            @method("DELETE")
                                            <button title="Delete Backup" class="btn btn-sm bg-danger-light" type="submit">
                                                <i class="fe fe-trash-2"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="pf-empty">
                                        <div class="pf-empty-icon"><i class="fe fe-archive"></i></div>
                                        <h5>No backups available</h5>
                                        <p>Create a backup to protect your system records.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>			
</div>
@endsection