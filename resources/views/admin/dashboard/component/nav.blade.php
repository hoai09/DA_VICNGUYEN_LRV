<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        <form role="search" class="navbar-form-custom" action="search_results.html">
            <div class="form-group">
                {{-- <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search"> --}}
            </div>
        </form>
    </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message"></span>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>
            
                    @if($contactUnreadCount > 0)
                        <span class="label label-warning">
                            {{ $contactUnreadCount }}
                        </span>
                    @endif
                </a>
            
                <ul class="dropdown-menu dropdown-messages">
            
                    @forelse($latestContactAdvices as $contact)
                        <li>
                            <div class="dropdown-messages-box">
                                <div>
                                    <small class="pull-right">
                                        {{ $contact->created_at->diffForHumans() }}
                                    </small>
            
                                    <strong>{{ $contact->full_name }}</strong><br>
            
                                    <small class="text-muted">
                                        {{ $contact->phone ?? $contact->email }}
                                    </small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                    @empty
                        <li class="text-center">
                            <small>Chưa có yêu cầu tư vấn</small>
                        </li>
                    @endforelse
            
                    <li>
                        <div class="text-center link-block">
                            <a href="{{ route('admin.form.index') }}">
                                <i class="fa fa-envelope"></i>
                                <strong>Xem tất cả tư vấn</strong>
                            </a>
                        </div>
                    </li>
            
                </ul>
            </li>
            
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>
            
                    @if($contactUnreadCount > 0)
                        <span class="label label-primary">
                            {{ $contactUnreadCount }}
                        </span>
                    @endif
                </a>
            
                <ul class="dropdown-menu dropdown-alerts">
            
                    @forelse($latestContactAdvices as $contact)
                        <li>
                            <a href="{{ route('admin.form.show', $contact->id) }}">
                                <div>
                                    <i class="fa fa-info-circle fa-fw"></i>
                                    Khách hàng mới:
                                    <strong>{{ $contact->full_name }}</strong>
            
                                    <span class="pull-right text-muted small">
                                        {{ $contact->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    @empty
                        <li class="text-center text-muted p-2">
                            Không có thông báo mới
                        </li>
                    @endforelse
            
                    <li>
                        <div class="text-center link-block">
                            <a href="{{ route('admin.form.index') }}">
                                <strong>Xem tất cả</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"
                    onclick="event.preventDefault(); document.getElementById('logoutnav-form').submit();">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            
                <form id="logoutnav-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>

    </nav>
</div>