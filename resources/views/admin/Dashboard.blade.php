@extends('admin.layouts.home')  

@section('content')
<div class="container-fluid py-4">

    <div class="row mb-4">
        <div class="col-md-3">
            <select id="yearFilter" class="form-select">
                @for($y=date('Y'); $y>=date('Y')-5; $y--)
                    <option value="{{ $y }}" {{ $y==$year?'selected':'' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <select id="statusFilter" class="form-select">
                <option value="all" {{ $statusFilter=='all'?'selected':'' }}>Tất cả trạng thái</option>
                <option value="Đang triển khai" {{ $statusFilter=='Đang triển khai'?'selected':'' }}>Đang triển khai</option>
                <option value="Hoàn thành" {{ $statusFilter=='Hoàn thành'?'selected':'' }}>Hoàn thành</option>
                <option value="Tạm dừng" {{ $statusFilter=='Tạm dừng'?'selected':'' }}>Tạm dừng</option>
            </select>
        </div>
        <div class="col-md-3">
            <select id="newsFilter" class="form-select">
                <option value="all" {{ $newsFilter=='all'?'selected':'' }}>Tất cả tin tức</option>
                <option value="featured" {{ $newsFilter=='featured'?'selected':'' }}>Tin nổi bật</option>
            </select>
        </div>
        <div class="col-md-3">
            <button id="filterBtn" class="btn btn-primary w-100">
                <i class="fa-solid fa-filter"></i>
                Áp dụng
            </button>
        </div>
    </div>


    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm text-white bg-primary bg-gradient">
                <div class="card-body">
                    <h5>Dự án</h5>
                    <h2>{{ $projectCount }}</h2>
                    <p>Xong: {{ $doneProjects }} | Đang TH: {{ $doingProjects }} | Tạm dừng: {{ $pausedProjects }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm text-white bg-success bg-gradient">
                <div class="card-body">
                    <h5>Tin tức</h5>
                    <h2>{{ $newsCount }}</h2>
                    <p> Mới: {{ $recentNews->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm text-dark bg-warning bg-gradient">
                <div class="card-body">
                    <h5>Form khách hàng</h5>
                    <h2>{{ $formCount }}</h2>
                    <p>Mới: {{ $recentForms->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Dự án</div>
                <div class="card-body">
                    <canvas id="projectsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Tin tức</div>
                <div class="card-body">
                    <canvas id="newsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-4">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">Form từ khách hàng</div>
                <div class="card-body">
                    <canvas id="formsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){

    document.getElementById('filterBtn').addEventListener('click', function(){
        const year = document.getElementById('yearFilter').value;
        const status = document.getElementById('statusFilter').value;
        const news = document.getElementById('newsFilter').value;
        window.location.href = `?year=${year}&project_status=${status}&news_type=${news}`;
    });

    const monthLabels = ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'];

    new Chart(document.getElementById('projectsChart'), {
        type:'bar',
        data:{
            labels: monthLabels,
            datasets:[{
                label:'Dự án',
                data:@json(array_values($monthlyProjects)),
                backgroundColor:'rgba(13,110,253,0.7)',
                borderColor:'rgba(13,110,253,1)',
                borderWidth:1
            }]
        },
        options:{responsive:true,maintainAspectRatio:false}
    });

    new Chart(document.getElementById('newsChart'), {
        type:'bar',
        data:{
            labels: monthLabels,
            datasets:[{
                label:'Tin tức',
                data:@json(array_values($monthlyNews)),
                backgroundColor:'rgba(25,135,84,0.7)',
                borderColor:'rgba(25,135,84,1)',
                borderWidth:1
            }]
        },
        options:{responsive:true,maintainAspectRatio:false}
    });

    new Chart(document.getElementById('formsChart'), {
        type:'doughnut',
        data:{
            labels: monthLabels,
            datasets:[{
                label:'Form',
                data:@json(array_values($monthlyForms)),
                backgroundColor:[
                    '#0d6efd','#198754','#ffc107','#dc3545','#6610f2','#0dcaf0','#fd7e14','#6f42c1','#20c997','#fd1987','#adb5bd','#495057'
                ]
            }]
        },
        options:{responsive:true,maintainAspectRatio:false}
    });

});
</script>
@endsection
