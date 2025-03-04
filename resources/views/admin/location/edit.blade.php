@extends('admin.layouts.app')

@section('title', 'Edit Location')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Edit Location</h1>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Location</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('locations.update', $location->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $location->name) }}" placeholder="Enter name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $location->email) }}" placeholder="Enter email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone', $location->telephone) }}" placeholder="Enter telephone">
                                    @error('telephone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="consignment_note_required">Consignment Note Required?</label>
                                    <select name="consignment_note_required" id="consignment_note_required" class="form-control">
                                        <option value="">--Select--</option>
                                        <option value="1" {{ old('consignment_note_required', $location->consignment_note_required) == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('consignment_note_required', $location->consignment_note_required) == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="permit_number">Permit Number</label>
                                    <input type="text" class="form-control @error('permit_number') is-invalid @enderror" id="permit_number" name="permit_number" value="{{ old('permit_number', $location->permit_number) }}" placeholder="Enter permit number">
                                    @error('permit_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website', $location->website) }}" placeholder="Enter website">
                                    @error('website')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror">
                                        <option>--Select Country--</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id', $location->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="area_id" class="form-label">Area</label>
                                    <select name="area_id" id="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                        <option>--Select Area--</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}" {{ old('area_id', $location->area_id) == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('area_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address_id" class="form-label">Address</label>
                                    <select name="address_id" id="address_id" class="form-control @error('address_id') is-invalid @enderror">
                                        <option>--Select Address--</option>
                                        @foreach($addresses as $address)
                                            <option value="{{ $address->id }}" {{ old('address_id', $location->address_id) == $address->id ? 'selected' : '' }}>
                                                {{ $address->address_line_one }}, {{ $address->address_line_two }}, {{ $address->address_line_three }}, {{ $address->address_line_four }}, {{ $address->postcode }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('address_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('locations.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')


@endpush
