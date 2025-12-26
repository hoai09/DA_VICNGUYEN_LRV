

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.headtitle.title') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.headtitle.title') }}</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
    
        <div class="col-lg-12">
            <div class="ibox">
                @if(session('success'))
                    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
                @endif
            
                    <div class="ibox-content p-0">
                        <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 form-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Loại dự án</th>
                                    <th>Diện tích</th>
                                    <th>Ngày gửi</th>
                                    <th>Trạng thái</th>
                                    <th width="140px" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($information as $info)
                                <tr>
                                    <td class="fw-semibold">{{ $info->full_name }}</td>
                                    <td>{{ $info->email }}</td>
                                    <td>{{ $info->phone }}</td>
                                    <td>
                                        <span class="badge-type">
                                            {{ $info->category->name ?? ' ' }}
            
                                        </span>
                                    </td>
                                    <td>{{ $info->area }}</td>
                                    <td>{{ $info->created_at->format('d/m/Y H:i') }}</td>
            
                                    <td>
                                        <form action="{{ route('admin.form.status', ['form' => $info->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                        
                                            <button type="submit" class="badge {{ $info->status ? 'bg-success' : 'bg-danger text-dark' }} border-0">
                                                {{ $info->status ? 'Đã hoàn thành' : 'Chưa xử lý' }}
                                            </button>
                                        </form>
                                        
                                    </td>
            
                                    <td class="flex-row gap-1 justify-content-center text-center">
            
                                        <a href="{{ route('admin.form.show', $info->id) }}"
                                        class="btn btn-info btn-sm action-btn">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
            
                                        <form action="{{ route('admin.form.destroy', $info->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                onclick="return confirm('Bạn có chắc muốn xoá không?')" 
                                                class="btn btn-danger btn-sm action-btn">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
            
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                
            
                <div class="mt-3 px-3">
                    {{ $information->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div >
        </div>
    </div>
</div>



