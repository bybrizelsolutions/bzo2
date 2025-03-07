@extends('admin.layouts.app')

@section('title', 'Create New Product')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Add New Product</h1>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control @error('vehicle_type') is-invalid @enderror">
                                        <option>--Select Vehicle Type--</option>
                                        <option value="0" {{ old('vehicle_type') == "0" ? 'selected' : '' }}>Car</option>
                                        <option value="1" {{ old('vehicle_type') == "1" ? 'selected' : '' }}>Truck</option>
                                        <option value="2" {{ old('vehicle_type') == "2" ? 'selected' : '' }}>Bus</option>
                                        <option value="3" {{ old('vehicle_type') == "3" ? 'selected' : '' }}>Motorcycle</option>
                                    </select>
                                    @error('vehicle_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="registration">Registration</label>
                                    <input type="text" class="form-control @error('registration') is-invalid @enderror" id="registration" name="registration" value="{{ old('registration') }}" placeholder="Enter registration">
                                    @error('registration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="make">Make</label>
                                    <input type="text" class="form-control" id="make" name="make" value="{{ old('make') }}" placeholder="Enter make">
                                </div>
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" placeholder="Enter model">
                                </div>
                                <div class="form-group">
                                    <label for="purchase_date">Purchase Date</label>
                                    <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}" placeholder="Enter purchase date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purchase_from">Purchase From</label>
                                    <input type="text" class="form-control" id="purchase_from" name="purchase_from" value="{{ old('purchase_from') }}" placeholder="Enter purchase from">
                                </div>
                                <div class="form-group">
                                    <label for="service_by">Service By</label>
                                    <input type="text" class="form-control" id="service_by" name="service_by" value="{{ old('service_by') }}" placeholder="Enter service by">
                                </div>
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" value="{{ old('notes') }}" placeholder="Enter notes"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="mileage">Mileage</label>
                                    <input type="text" class="form-control" id="mileage" name="mileage" value="{{ old('mileage') }}" placeholder="Enter mileage">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')


@endpush
