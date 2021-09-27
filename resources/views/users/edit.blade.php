@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-backward fa-sm text-white-50"></i> Go Back</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form class="user" method="post" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="first_name" class="form-control form-control-user @error('first_name') is-invalid @enderror" id="exampleFirstName" placeholder="First Name" value="{{ $user->first_name }}">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="text" name="last_name" class="form-control form-control-user @error('last_name') is-invalid @enderror" id="exampleLastName" placeholder="Last Name" value="{{ $user->last_name }}">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" name="username" class="form-control form-control-user @error('username') is-invalid @enderror" id="exampleInputPassword" placeholder="Username" value="{{ $user->username }}">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <input type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleRepeatPassword" placeholder="Email" value="{{ $user->email }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Update Account
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="user" method="post" action="{{ route('users.change.password', $user) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-sm-4">
                        <input type="password" name="password_confirmation" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Change Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
