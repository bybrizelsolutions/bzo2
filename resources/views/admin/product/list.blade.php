@extends('admin.layouts.app')

@section('title', 'Product Listing')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Product List</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                <a href="{{ route('products.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add New Product</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
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
                ajax: "{{ route('products.index') }}",  // Same route for both Blade & AJAX
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'status_label', name: 'status_label', orderable: false, searchable: false },
                    {data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });

        // Handle delete action
        $(document).on('click', '.delete-product', function(e) {
            e.preventDefault();
            let pId = $(this).data('id');

            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: "{{ url('products/delete') }}/" + pId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        alert(response.success);
                        window.location.href = "{{ route('products.index') }}";
                    },
                    error: function(xhr) {
                        alert('Error deleting product');
                    }
                });
            }
        });

    </script>

@endpush
