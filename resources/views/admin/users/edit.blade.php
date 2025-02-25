@extends('admin.layouts.app')

@section('title', 'Edit User Details')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit User Details</h1>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Edit User Details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" placeholder="Enter Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="role_id" class="form-label">Role</label>
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option>--Select Role--</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}" placeholder="Enter mobile" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" placeholder="Enter phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="signature">Signature</label>
                                    <input type="file" class="form-control" id="signature" name="signature" placeholder="Enter Signature">
                                    @if($user->signature)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/signatures/' . $user->signature) }}" alt="Signature" style="max-width: 100px; border: 1px solid #ddd; padding: 5px;">
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option>--Select Status--</option>
                                        <option value="0" {{ $user->status == '0' ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ $user->status == '1' ? 'selected' : '' }}>Deactivated</option>
                                        <option value="2" {{ $user->status == '2' ? 'selected' : '' }}>Suspended</option>
                                        <option value="3" {{ $user->status == '3' ? 'selected' : '' }}>Deleted</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')


@endpush
