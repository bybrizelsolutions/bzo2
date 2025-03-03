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
                                <th>Short Name</th>
                                <th>Category</th>
                                <th>Base Price one</th>
                                <th>Size</th>
                                <th>Vehicle Type</th>
                                <th>Instructions</th>
                                <th>Service Type</th>
                                <th>Pwc EVC Code</th>
                                <th>Prd Component</th>
                                <th>Pence Flag</th>
                                <th>Full Weight</th>
                                <th>Empty Weight</th>
                                <th>H2O</th>
                                <th>CL</th>
                                <th>S</th>
                                <th>Solid</th>
                                <th>FP</th>
                                <th>Ash</th>
                                <th>Vehicle & Man Hire</th>
                                <th>Per Tonne Disposal</th>
                                <th>Service Check</th>
                                <th>Status</th>
                                <th>Prd Default Consignment Note Type</th>
                                <th>Prd Hazard Codes</th>
                                <th>Consignment Category</th>
                                <th>Prd Physical Form</th>
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
                    {data: 'short_name', name: 'short_name'},
                    {data: 'category', name: 'category'},
                    {data: 'base_price_one', name: 'base_price_one'},
                    {data: 'size', name: 'size'},
                    {data: 'vehicle_type', name: 'vehicle_type'},
                    {data: 'instructions', name: 'instructions'},
                    {data: 'service_type', name: 'service_type'},
                    {data: 'prd_ewc_code', name: 'prd_ewc_code'},
                    {data: 'prd_component', name: 'prd_component'},
                    {data: 'pence_flag', name: 'pence_flag'},
                    {data: 'full_weight', name: 'full_weight'},
                    {data: 'empty_weight', name: 'empty_weight'},
                    {data: 'h2o', name: 'h2o'},
                    {data: 'cl', name: 'cl'},
                    {data: 's', name: 's'},
                    {data: 'solid', name: 'solid'},
                    {data: 'fp', name: 'fp'},
                    {data: 'ash', name: 'ash'},
                    {data: 'vehicle_and_man_hire', name: 'vehicle_and_man_hire'},
                    {data: 'per_tonne_disposal', name: 'per_tonne_disposal'},
                    {data: 'service_check', name: 'service_check'},
                    {data: 'status_label', name: 'status_label', orderable: false, searchable: false },
                    {data: 'prd_default_consignment_note_type', name: 'prd_default_consignment_note_type'},
                    {data: 'prd_hazard_codes_id', name: 'prd_hazard_codes_id'},
                    {data: 'consignment_category_id', name: 'consignment_category_id'},
                    {data: 'prd_physical_form_id', name: 'prd_physical_form_id'},
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
