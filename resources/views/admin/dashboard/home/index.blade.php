<div class="wrapper wrapper-content dashboard-modern">
    
    <div class="row">
        @php
            $stats_config = [
                ['label' => 'Dự án', 'value' => $stats['projects'], 'icon' => 'fa-briefcase', 'class' => 'grad-primary'],
                ['label' => 'Thành viên', 'value' => $stats['members'], 'icon' => 'fa-users', 'class' => 'grad-info'],
                ['label' => 'Bài viết', 'value' => $stats['news'], 'icon' => 'fa-newspaper-o', 'class' => 'grad-success'],
                ['label' => 'Liên hệ', 'value' => $stats['contacts'], 'icon' => 'fa-comments', 'class' => 'grad-danger'],
            ];
        @endphp

        @foreach($stats_config as $item)
        <div class="col-lg-3 col-md-6">
            <div class="ibox modern-stat-card {{ $item['class'] }}">
                <div class="ibox-content ">
                    <div class="stat-icon"><i class="fa {{ $item['icon'] }}"></i></div>
                    <div class="stat-info">
                        <h2 class="no-margins font-bold">{{ number_format($item['value']) }}</h2>
                        <small class="text-uppercase" style="opacity: 0.8">{{ $item['label'] }}</small>
                    </div>
                    <div class="progress progress-mini m-t-sm" style="background: rgba(255,255,255,0.2)">
                        <div style="width: 70%;" class="progress-bar progress-bar-white"></div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row m-t-md">
        <div class="col-lg-12">
            <div class="ibox modern-box">
                <div class="ibox-title">
                    <h5><i class="fa fa-line-chart text-navy"></i> Thống kê dự án</h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <a href="{{ request()->fullUrlWithQuery(['period' => 'today']) }}" class="btn btn-xs btn-white {{ $period === 'today' ? 'active' : '' }}">Today</a>
                            <a href="{{ request()->fullUrlWithQuery(['period' => 'monthly']) }}" class="btn btn-xs btn-white {{ $period === 'monthly' ? 'active' : '' }}">Monthly</a>
                            <a href="{{ request()->fullUrlWithQuery(['period' => 'annual']) }}" class="btn btn-xs btn-white {{ $period === 'annual' ? 'active' : '' }}">Annual</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart" style="height: 300px;">
                                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 border-left">
                            <div class="p-h-md">
                                <h4 class="font-bold">Chỉ số chu kỳ</h4>
                                <ul class="list-group clear-list m-t">
                                    <li class="list-group-item fist-item">
                                        <span class="pull-right font-bold" id="stat-total">0</span> Tổng dự án
                                    </li>
                                    <li class="list-group-item">
                                        <span class="pull-right font-bold text-navy" id="stat-current">0</span> Kỳ hiện tại
                                    </li>
                                    <li class="list-group-item">
                                        <div class="stat-percent font-bold text-info" id="stat-percent">0% <i class="fa fa-level-up"></i></div> Tăng trưởng
                                    </li>
                                </ul>
                                {{-- <div class="alert alert-info small m-t-sm">
                                    
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-t-md">
        <div class="col-lg-12">
            <div class="ibox modern-box">
                <div class="ibox-title">
                    <h5><i class="fa fa-address-card-o text-danger"></i> Yêu cầu tư vấn mới nhất</h5>
                    <div class="ibox-tools">
                        <span class="label label-warning-light pull-right">{{ $formStats['pending'] }} Chờ xử lý</span>
                    </div>
                </div>
                <div class="ibox-content p-none">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover no-margins">
                            <thead>
                                <tr>
                                    <th class="p-m">Loại Site</th>
                                    <th>Khách hàng</th>
                                    <th>Email liên hệ</th>
                                    <th>Thời gian</th>
                                    <th class="text-right p-m">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($formStats['latest'] as $item)
                                    <tr>
                                        <td class="p-m">
                                            <span class="label label-{{ $item->type === 'Contact' ? 'info' : 'success' }} label-outline">
                                                {{ $item->type }}
                                            </span>
                                        </td>
                                        <td class="font-bold">{{ $item->fname }}</td>
                                        <td><i class="fa fa-envelope-o"></i> {{ $item->email }}</td>
                                        <td>
                                            <span class="text-navy small"><i class="fa fa-clock-o"></i> {{ $item->created_at->format('d/m/Y H:i') }}</span>
                                        </td>
                                        <td class="text-right p-m">
                                            <a href="
                                                    @if($item->type === 'Contact')
                                                        {{ route('admin.form.show', $item->id) }}
                                                    @else
                                                        {{ route('admin.formPortfolio.show', $item->id) }}
                                                    @endif
                                                "class="btn btn-white btn-sm">
                                                <i class="fa fa-folder"></i> Xem
                                            </a>

                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="p-xl text-center text-muted">Chưa có dữ liệu mới</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-t-md">
        <div class="col-lg-6">
            <div class="ibox modern-box">
                <div class="ibox-title">
                    <h5><i class="fa fa-user-plus text-info"></i> Thành viên mới</h5>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list custom-scroll" style="height: 300px; overflow-y: auto;">
                        @foreach ($latest['members'] as $member)
                        <div class="feed-element">
                            <a href="#" class="pull-left">
                                <img class="img-circle" src="{{ $member->image ? asset('storage/'.$member->image) : asset('admin/img/avatar_default.png') }}">
                            </a>
                            <div class="media-body">
                                <small class="pull-right text-navy">{{ $member->created_at->diffForHumans() }}</small>
                                <strong>{{ $member->name }}</strong><br>
                                <small class="text-muted">Năm tham gia: {{ $member->join_year ?? 'N/A' }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox modern-box">
                <div class="ibox-title">
                    <h5><i class="fa fa-newspaper-o text-success"></i> Tin tức & Bài viết</h5>
                </div>
                <div class="ibox-content">
                    <div class="row text-center m-b-lg">
                        <div class="col-xs-4">
                            <h2 class="no-margins">{{ $newsStats['total'] }}</h2>
                            <small class="text-muted">Tổng số</small>
                        </div>
                        <div class="col-xs-4 border-left border-right">
                            <h2 class="no-margins text-navy">{{ $newsStats['today'] }}</h2>
                            <small class="text-muted">Hôm nay</small>
                        </div>
                        <div class="col-xs-4">
                            <h2 class="no-margins text-success">{{ $newsStats['month'] }}</h2>
                            <small class="text-muted">Tháng này</small>
                        </div>
                    </div>
                    <table class="table table-hover no-margins">
                        <thead>
                            <tr><th>Tiêu đề bài viết mới</th><th width="100">Ngày đăng</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($newsStats['latest'] as $news)
                            <tr>
                                <td><small>{{ Str::limit($news->title, 45) }}</small></td>
                                <td><i class="fa fa-calendar"></i> {{ $news->created_at->format('d/m') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.DASHBOARD = {
        projectChart: @json($projectChart ?? []),
    };
</script>


<script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
