@extends('admin.layouts.app')

@section('title', 'Create New Vehicle')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Add New Vehicle</h1>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Vehicle</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('vehicles.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type_id" class="form-label">Vehicle Type</label>
                                    <select name="vehicle_type_id" id="vehicle_type_id" class="form-control @error('vehicle_type_id') is-invalid @enderror">
                                        <option>--Select Vehicle Type--</option>
                                        @foreach($vehicle_types as $vehicle_type)
                                            <option value="{{ $vehicle_type->id }}" {{ old('vehicle_type_id') == $vehicle_type->id ? 'selected' : '' }}>{{ $vehicle_type->type }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_type_id')
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
                            <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')


@endpush
