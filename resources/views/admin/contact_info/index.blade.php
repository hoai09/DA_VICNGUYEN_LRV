@extends('admin.layouts.app')
@section('header')
<h3>ContactInfomation-Admin</h3>
@endsection
@section('content')
<div class="container mt4">
    <h2 class="mb-4 text-black"> Danh sách thông tin liên hệ</h2>
    <a href="{{ route('admin.contact_info.create') }}" class="btn btn-outline-info mb-3">Thêm</a>
    @session('success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong>{{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-lable="Close"></button>
            </div>
            @endsession
    <table class="table table-bordered table-light table-striped">
        <thead>
        <tr>
            <th>STT</th>
            <th>Địa chỉ</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Map</th>
            <td>Thao tác</td>
        </tr>
        </thead>
        <tbody>
            @forelse ($contactInfos as $info)
            
            <tr>
                <td>{{ $info->id }}</td>
                <td>{{ $info->address }}</td>
                <td>{{ $info->email }}</td>
                <td>{{ $info->phone }}</td>
                <td>{{ $info->map_image }}</td>
                <td>
                    <a href="{{ route('admin.contact_info.show',$info->id) }}" class="btn btn-outline-warning">Xem</a>
                    <a href="{{ route('admin.contact_info.edit',$info->id) }}" class="btn btn-outline-danger">Sửa</a>
                    
                    <button type="button" class="btn btn-outline-danger delete-btn" 
                    data-id="{{ $info->id }}"
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteContactInfoModal"
                >
                    Xoá
                </button>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Không tìm thấy thông tin liên hệ</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-end mt-4">
    {{ $contactInfos->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

<div class="modal fade" id="deleteContactInfoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-light text-black">
            <div class="modal-header border-0">
                <h5 class="modal-title"> Xoá thông tin liên hệ ?</h5>
                    <button class="btn-close btn-close-black"
                            type="button"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xoá thông tin này không</p>
                <p>Sau khi xoá không thể khôi phục </p>
            </div>
                <div class="modal-footer border-0">
                    <button
                    type="button"
                    class="btn btn-outline-dack"
                    data-bs-dismiss="modal">Cancel
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Xoá thông tin
                    </button>
                </form>  
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded',function(){
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const deleteForm = document.getElementById('deleteForm');
        deleteButtons.forEach(button => {button.addEventListener('click',function(){
            const contactId = this.dataset.id;
            deleteForm.action = `/admin/contactInfos/${contactId}`;

            });
        });

    });
</script>
@endsection
