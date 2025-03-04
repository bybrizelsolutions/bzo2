@extends('admin.layouts.app')

@section('title', 'Address Listing')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Address List</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Address List</h6>
                <a href="{{ route('addresses.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add New Address</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Address</th>
                                <th>Area</th>
                                <th>Country</th>
                                <th>Action</th>
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
                ajax: "{{ route('addresses.index') }}",  // Same route for both Blade & AJAX
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'full_address', name: 'full_address'},
                    {data: 'area.name', name: 'area.name'},
                    {data: 'country.name', name: 'country.name'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });

        // Handle delete action
        $(document).on('click', '.delete-address', function(e) {
            e.preventDefault();
            let addressId = $(this).data('id');

            if (confirm('Are you sure you want to delete this address?')) {
                $.ajax({
                    url: "/addresses/" + addressId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        alert(response.success);
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Error deleting address');
                    }
                });
            }
        });
    </script>

@endpush
