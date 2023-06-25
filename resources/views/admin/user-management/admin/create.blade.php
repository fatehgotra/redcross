@extends('layouts.admin')
@section('title', 'Add User')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">User Management</a></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add User</h4>
                </div>
            </div>
        </div>
        @include('admin.includes.flash-message')
        <!-- end page title -->

    </div> <!-- container -->
    <form method="POST" action="{{ route('admin.admins.store') }}" id="supplierForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <h3>User Details</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <code id="name-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="email" class="form-label">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Email Address"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <code id="email-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <code id="phone-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="password" id="password"
                                    placeholder="Password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <code id="password-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>  
                            <div class="col-md-6 mb-2">
                                <label for="roles" class="form-label">Roles<span
                                        class="text-danger">*</span></label>
                                <select name="roles[]" data-toggle="select2" id="roles" class="form-select" multiple>
                                    <option value=""></option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ in_array($role->id, old('roles', [])) ||(isset($user) && $user->roles->contains($role->id))? 'selected': '' }}>
                                        {{ ucfirst(str_replace('-', ' ', $role->name)) }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <code id="supplier_id-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>   
                            <div class="col-md-6">
                                <label for="branch" class="form-label">Branch <span class="text-danger">*</span></label>
                                <select id="branch"
                                    class="form-select"
                                    name="branch">
                                    <option value="">Please Select</option>
                                    <optgroup label="Central / Eastern">
                                        <option value="Rotuma"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Rotuma' ? 'selected' : '' }}>
                                            Rotuma
                                        </option>
                                        <option value="Levuka"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Levuka' ? 'selected' : '' }}>
                                            Levuka
                                        </option>
                                        <option value="Suva"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Suva' ? 'selected' : '' }}>
                                            Suva
                                        </option>
                                    </optgroup>
                                    <optgroup label="Western">
                                        <option value="Sigatoka"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Sigatoka' ? 'selected' : '' }}>
                                            Sigatoka
                                        </option>
                                        <option value="Nadi"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Nadi' ? 'selected' : '' }}>
                                            Nadi
                                        </option>
                                        <option value="Lautoka"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Lautoka' ? 'selected' : '' }}>
                                            Lautoka
                                        </option>
                                        <option value="Ba"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Ba' ? 'selected' : '' }}>
                                            Ba
                                        </option>
                                        <option value="Tavua"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Tavua' ? 'selected' : '' }}>
                                            Tavua
                                        </option>
                                        <option value="Rakiraki"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Rakiraki' ? 'selected' : '' }}>
                                            Rakiraki
                                        </option>
                                        <option value="Nalawa"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Nalawa' ? 'selected' : '' }}>
                                            Nalawa
                                        </option>
                                    </optgroup>
                                    <optgroup label="Northern">
                                        <option value="Bua"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Bua' ? 'selected' : '' }}>
                                            Bua
                                        </option>
                                        <option value="Seaqaqa"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Seaqaqa' ? 'selected' : '' }}>
                                            Seaqaqa
                                        </option>
                                        <option value="Savusavu"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Savusavu' ? 'selected' : '' }}>
                                            Savusavu
                                        </option>
                                        <option value="Labasa"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Labasa' ? 'selected' : '' }}>
                                            Labasa
                                        </option>
                                        <option value="Taveuni"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Taveuni' ? 'selected' : '' }}>
                                            Taveuni
                                        </option>
                                        <option value="Rabi"
                                            {{ old('branch', isset($user) ? $user->branch : '') == 'Rabi' ? 'selected' : '' }}>
                                            Rabi
                                        </option>
                                    </optgroup>
                                </select>
                                @error('branch')
                                    <code id="branch-error" class="text-danger">{{ $message }}</code>
                                @enderror
                            </div>                      
                            <div class="col-md-12 mb-2 text-end">
                                <button type="submit" class="btn btn-sm btn-warning" form="supplierForm">Save</button>
                                <a href="{{ route('admin.admins.index') }}" class="btn btn-sm btn-dark">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
