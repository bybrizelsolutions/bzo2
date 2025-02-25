@extends('admin.layouts.app')

@section('title', 'Trashed User Listing')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Trashed User List</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Deleted List</h6>
                <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Back to Users</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Mobile</th>
                                <th>Deleted At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>

        $(document).ready(function () {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.trashed') }}",  // Same route for both Blade & AJAX
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'role_name', name: 'role_name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'deleted_at', name: 'deleted_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });

        $(document).on('click', '.restore-user', function () {
            var userId = $(this).data('id');

            $.ajax({
                url: '/users/restore/' + userId,
                type: 'POST',
                data: {_token: '{{ csrf_token() }}'},
                success: function (response) {
                    alert(response.success);
                    $('.data-table').DataTable().ajax.reload();
                }
            });
        });

        $(document).on('click', '.force-delete-user', function () {
            var userId = $(this).data('id');

            if (confirm('Are you sure you want to permanently delete this user?')) {
                $.ajax({
                    url: '/users/force-delete/' + userId,
                    type: 'DELETE',
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        alert(response.success);
                        $('.data-table').DataTable().ajax.reload();
                    }
                });
            }
        });

    </script>

@endpush
