@extends('admin.layouts.app')

@section('title', 'Vehicle Listing')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Vehicle List</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Vehicle List</h6>
                <a href="{{ route('vehicles.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Add New Vehicle</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vehicle Type</th>
                                <th>Registration</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Purchase Date</th>
                                <th>Purchase From</th>
                                <th>Service By</th>
                                <th>Notes</th>
                                <th>Mileage</th>
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
                ajax: "{{ route('vehicles.index') }}",  // Same route for both Blade & AJAX
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'vehicle_type', name: 'vehicleType.type'},
                    {data: 'registration', name: 'registration'},
                    {data: 'make', name: 'make'},
                    {data: 'model', name: 'model'},
                    {data: 'purchase_date', name: 'purchase_date'},
                    {data: 'purchase_from', name: 'purchase_from'},
                    {data: 'service_by', name: 'service_by'},
                    {data: 'notes', name: 'notes'},
                    {data: 'mileage', name: 'mileage'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false },
                ]
            });
        });

        // Handle delete action
        $(document).on('click', '.delete-vehicle', function(e) {
            e.preventDefault();
            let vId = $(this).data('id');

            if (confirm('Are you sure you want to delete this vehicle?')) {
                $.ajax({
                    url: "{{ url('vehicles/delete') }}/" + vId,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        alert(response.success);
                        window.location.href = "{{ route('vehicles.index') }}";
                    },
                    error: function(xhr) {
                        alert('Error deleting vehicle');
                    }
                });
            }
        });

    </script>

@endpush
