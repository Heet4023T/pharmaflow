<!-- Header -->
<div class="header">

    <!-- Logo (for mobile) -->
    <div class="header-left">
        <a href="{{route('dashboard')}}" class="logo" style="display:flex;align-items:center;gap:8px;text-decoration:none;">
            <div style="width:28px;height:28px;background:var(--pf-primary);border-radius:7px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H14.82C14.4 1.84 13.3 1 12 1C10.7 1 9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V21C3 22.1 3.9 23 5 23H19C20.1 23 21 22.1 21 21V5C21 3.9 20.1 3 19 3ZM12 3C12.55 3 13 3.45 13 4C13 4.55 12.55 5 12 5C11.45 5 11 4.55 11 4C11 3.45 11.45 3 12 3ZM13 17H11V15H9V13H11V11H13V13H15V15H13V17ZM19 21H5V5H7V7H17V5H19V21Z" fill="white"/>
                </svg>
            </div>
            <span style="font-size:16px;font-weight:700;color:var(--pf-text);letter-spacing:-0.3px;">PharmaFlow</span>
        </a>
    </div>

    <!-- Sidebar Toggle -->
    <a href="javascript:void(0);" id="toggle_btn" title="Toggle Navigation Menu" aria-label="Toggle Navigation Menu">
        <i class="fas fa-bars"></i>
    </a>

    <!-- Mobile Toggle -->
    <a class="mobile_btn" id="mobile_btn" title="Mobile Menu" aria-label="Mobile Menu">
        <i class="fas fa-bars"></i>
    </a>

    <!-- Header Right -->
    <ul class="nav user-menu">

        <!-- Quick Sale -->
        <li class="nav-item">
            <a href="#" data-target="#add_sales" title="New Sale" data-toggle="modal" class="nav-link" style="font-size:15px;">
                <i class="fe fe-plus-circle"></i>
            </a>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown noti-dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="position:relative;">
                <i class="fe fe-bell"></i>
                @if(auth()->user()->unReadNotifications->count() > 0)
                <span class="badge">{{auth()->user()->unReadNotifications->count()}}</span>
                @endif
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="{{route('mark-as-read')}}" class="clear-noti">Mark all read</a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @forelse (auth()->user()->unReadNotifications as $notification)
                        <li class="notification-message">
                            <a href="{{route('read')}}">
                                <div class="media">
                                    <span class="avatar avatar-sm" style="width:38px;height:38px;border-radius:8px;overflow:hidden;flex-shrink:0;background:var(--pf-danger-light);display:flex;align-items:center;justify-content:center;">
                                        @if(!empty($notification->data['image'] ?? null))
                                        <img class="avatar-img" alt="Product" src="{{asset('storage/purchases/'.$notification->data['image'])}}">
                                        @else
                                        <i class="fe fe-alert-triangle" style="color:var(--pf-danger);font-size:16px;"></i>
                                        @endif
                                    </span>
                                    <div class="media-body" style="flex:1;min-width:0;padding-left:10px;">
                                        <h6 class="text-danger">Stock Alert</h6>
                                        <p class="noti-details">
                                            <span class="noti-title">{{$notification->data['product_name'] ?? 'Product'}} is running low — only {{$notification->data['quantity'] ?? '?'}} remaining.</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">{{$notification->created_at->diffForHumans()}}</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @empty
                        <li style="padding:24px;text-align:center;color:var(--pf-muted);font-size:13px;">
                            <i class="fe fe-bell-off" style="font-size:24px;display:block;margin-bottom:8px;opacity:0.5;"></i>
                            No new notifications
                        </li>
                        @endforelse
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="{{route('mark-as-read')}}">View all notifications</a>
                </div>
            </div>
        </li>

        <!-- User Menu -->
        <li class="nav-item dropdown has-arrow" style="margin-left:4px;">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" style="display:flex;align-items:center;gap:8px;padding:4px 10px;border-radius:var(--pf-radius);border:1px solid var(--pf-border);background:#ffffff;">
                <span class="user-img">
                    <img class="rounded-circle" style="width:28px;height:28px;object-fit:cover;" src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/img/avatar.png')}}" alt="avatar">
                </span>
                <span style="font-size:13px;font-weight:550;color:var(--pf-text);max-width:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{auth()->user()->name}}</span>
                <i class="fe fe-chevron-down" style="font-size:12px;color:var(--pf-muted);"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/img/avatar.png')}}" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{auth()->user()->name}}</h6>
                        <div style="font-size:11px;color:var(--pf-muted);">{{auth()->user()->email}}</div>
                    </div>
                </div>

                <a class="dropdown-item" href="{{route('profile')}}">
                    <i class="fe fe-user" style="font-size:13px;"></i> My Profile
                </a>
                @can('view-settings')
                <a class="dropdown-item" href="{{route('settings')}}">
                    <i class="fe fe-settings" style="font-size:13px;"></i> Settings
                </a>
                @endcan

                <div style="margin: 6px 8px;border-top:1px solid var(--pf-border);"></div>

                <div class="dropdown-item" style="padding:0;">
                    <form action="{{route('logout')}}" method="post" style="margin:0;">
                        @csrf
                        <button type="submit" style="display:flex;align-items:center;gap:8px;width:100%;padding:8px 10px;background:none;border:none;color:var(--pf-danger);font-size:13.5px;font-weight:450;cursor:pointer;font-family:inherit;border-radius:var(--pf-radius);transition:background 0.2s;" onmouseover="this.style.background='var(--pf-danger-light)'" onmouseout="this.style.background='none'">
                            <i class="fe fe-log-out" style="font-size:13px;"></i> Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </li>
        <!-- /User Menu -->

    </ul>
    <!-- /Header Right -->

</div>
<!-- /Header -->