@extends('admin.layouts.app')

@section('title', 'Create New Vehicle Type')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Add New Vehicle Type</h1>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Vehicle Type</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('vehicle_types.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" placeholder="Enter vehicle type">
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('vehicle_types.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')


@endpush
