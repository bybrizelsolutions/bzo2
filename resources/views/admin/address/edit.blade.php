@extends('admin.layouts.app')

@section('title', 'Edit Address')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Edit Address</h1>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Address</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('addresses.update', $address->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address_line_one">Address Line One</label>
                                    <input type="text" class="form-control @error('address_line_one') is-invalid @enderror" id="address_line_one" name="address_line_one" value="{{ old('address_line_one', $address->address_line_one) }}" placeholder="Enter address line one">
                                    @error('address_line_one')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address_line_two">Address Line Two</label>
                                    <input type="text" class="form-control" id="address_line_two" name="address_line_two" value="{{ old('address_line_two', $address->address_line_two) }}" placeholder="Enter address line two">
                                </div>
                                <div class="form-group">
                                    <label for="address_line_three">Address Line Three</label>
                                    <input type="text" class="form-control" id="address_line_three" name="address_line_three" value="{{ old('address_line_three', $address->address_line_three) }}" placeholder="Enter address line three">
                                </div>
                                <div class="form-group">
                                    <label for="address_line_four">Address Line Four</label>
                                    <input type="text" class="form-control" id="address_line_four" name="address_line_four" value="{{ old('address_line_four', $address->address_line_four) }}" placeholder="Enter address line four">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" class="form-control" id="postcode" name="postcode" value="{{ old('postcode', $address->postcode) }}" placeholder="Enter postcode">
                                </div>
                                <div class="form-group">
                                    <label for="area_id" class="form-label">Area</label>
                                    <select name="area_id" id="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                        <option>--Select Area--</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}" {{ old('area_id', $address->area_id) == $area->id ? 'selected' : '' }}>{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('area_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select name="country_id" id="country_id" class="form-control @error('country_id') is-invalid @enderror">
                                        <option>--Select Country--</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id', $address->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('addresses.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')


@endpush
