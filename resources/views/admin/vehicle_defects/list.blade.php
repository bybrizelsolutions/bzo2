@extends('admin.layouts.app')

@section('title', 'Vehicle Defects Listing')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Vehicle Defects List</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Vehicle Defects List</h6>
                <a href="{{ route('vehicle-defects.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add New Vehicle Defects</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Checklist Name</th>
                                <th>Vehicle Type</th>
                                <th>Notes</th>
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
                ajax: "{{ route('vehicle-defects.index') }}",  // Same route for both Blade & AJAX
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'checklist_name', name: 'checklist_name'},
                    {data: 'vehicle_type', name: 'vehicleType.type'},
                    {data: 'notes', name: 'notes'},
                    {data: 'status_label', name: 'status_label', orderable: false, searchable: false },
                    {data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });

        // Handle delete action
        $(document).on('click', '.delete-vehicle-defect', function(e) {
            e.preventDefault();
            let vdId = $(this).data('id');

            if (confirm('Are you sure you want to delete this vehicle defect?')) {
                $.ajax({
                    url: "{{ url('vehicle-defects/delete') }}/" + vdId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        alert(response.success);
                        window.location.href = "{{ route('vehicle-defects.index') }}";
                    },
                    error: function(xhr) {
                        alert('Error deleting vehicle defect');
                    }
                });
            }
        });

    </script>

@endpush
