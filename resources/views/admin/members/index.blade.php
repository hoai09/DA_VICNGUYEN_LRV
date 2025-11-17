@extends('admin.layouts.app')
@section('header')
<h3>MemberAdmin</h3>
@endsection
@section('content')
<div class="container mt4">
    <h2 class="mb-4 text-black"> Danh sách thành viên</h2>
    <a href="{{ route('admin.members.create') }}" class="btn btn-outline-info mb-3">Thêm</a>
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
            <th>Tên</th>
            <th>Ảnh</th>
            <th>Tốt nghiệp</th>
            <th>Trở thành Vicer</th>
            <th>Dự án tham gia</th>
            <th>Giải thưởng</th>
            <td>Chức vụ</td>
            <td>Thao tác</td>
        </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
            
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->image }}</td>
                <td>{{ $member->graduation_year }}</td>
                <td>{{ $member->join_year }}</td>
                <td>{{  $member->projects->pluck('title')->join(', ') }}</td>
                <td>{{ $member->awards }}</td>
                <td>{{ $member->projects->pluck('pivot.role')->join(', ')}}</td>
                <td>
                    <a href="{{ route('admin.members.show',$member->id) }}" class="btn btn-outline-warning">Xem</a>
                    <a href="{{ route('admin.members.edit',$member->id) }}" class="btn btn-outline-danger">Sửa</a>
                    
                    <button type="button" class="btn btn-outline-danger delete-btn" 
                    data-id="{{ $member->id }}"
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteMemberModal"
                >
                    Xoá
                </button>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Không tìm thấy thành viên</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-end mt-4">
    {{ $members->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

<div class="modal fade" id="deleteMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-light text-black">
            <div class="modal-header border-0">
                <h5 class="modal-title"> Xoá thành viên ?</h5>
                    <button class="btn-close btn-close-black"
                            type="button"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xoá thành viên này không</p>
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
                        Xoá thành viên
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
            const memberId = this.dataset.id;
            deleteForm.action = `/admin/members/${memberId}`;

            });
        });

    });
</script>
@endsection
