@extends('admin.layouts.app')

@section('title', 'Create New Vehicle Defect')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Add New Vehicle Defect</h1>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Vehicle Defect</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('vehicle-defects.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="checklist_name">Checklist Name</label>
                                    <input type="text" class="form-control @error('checklist_name') is-invalid @enderror" id="checklist_name" name="checklist_name" value="{{ old('checklist_name') }}" placeholder="Enter checklist name">
                                    @error('checklist_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_type_id">Vehicle Type</label>
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
                                    <label for="notes">Note</label>
                                    <textarea class="form-control" id="notes" name="notes" value="{{ old('notes') }}" placeholder="Enter notes"></textarea>
                                    @error('notes')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                        <option>--Select Status--</option>
                                        <option value="0" {{ old('status') == "0" ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ old('status') == "1" ? 'selected' : '' }}>Deactivated</option>
                                        <option value="2" {{ old('status') == "2" ? 'selected' : '' }}>Suspended</option>
                                        <option value="3" {{ old('status') == "3" ? 'selected' : '' }}>Deleted</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('vehicle-defects.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')


@endpush
