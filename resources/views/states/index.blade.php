@extends('layouts.main')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">States</h1>
        <div>
            <a href="{{ route('users.deleted') }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i
                    class="fas fa-trash fa-sm text-white-50"></i> Deleted Users</a>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                    data-target="#createModal">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                Add state
            </button>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <form class="form-inline float-right" method="get" action="{{ route('states.index') }}">
                <div class="input-group">
                    <input type="search" name="search" class="form-control bg-light small" placeholder="Search for..."
                           aria-label="Search" aria-describedby="basic-addon2" value="{{ request()->search }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Country Code</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($states as $state)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $state->name }}</td>
                            <td>{{ $state->country->country_code }}</td>
                            <td>
                                <button class="btn btn-primary btn-circle btn-sm editModal" data-toggle="modal"
                                        data-target="#editModal" data-url="{{route('states.update', $state)}}" data-name="{{ $state->name }}" data-country_id="{{ $state->country_id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-circle btn-sm deleteModal" data-toggle="modal"
                                        data-target="#deleteModal" data-url="{{route('states.destroy', $state)}}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    </tbody>
                </table>

                {{ $states->links() }}
            </div>
        </div>
    </div>

    <!-- Create Modal-->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('states.store') }}" method="post" class="deleteForm">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name"
                                   class="form-control form-control-user @error('name') is-invalid @enderror"
                                   id="exampleFirstName" placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="country_id" class="form-control">
                                @forelse($countries as $item)
                                    <option value="{{ $item->id }}">{{ $item->country_code }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" method="post">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="name"
                                   class="form-control form-control-user @error('name') is-invalid @enderror"
                                   id="exampleFirstName" placeholder="Name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select name="country_id" class="form-control">
                                @forelse($countries as $item)
                                    <option value="{{ $item->id }}">{{ $item->country_code }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure to delete?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    <form action="" method="post" class="deleteForm">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('.editModal').click(function () {
            var modal = $('#editModal');

            var url = $(this).data('url');
            var name = $(this).data('name');
            var country_id = $(this).data('country_id');

            modal.find('form').attr('action', url);
            modal.find('input[name=name]').val(name);
            modal.find('select[name=country_id]').val(country_id);
        });

        $('.deleteModal').click(function () {
            var url = $(this).data('url');

            $('.deleteForm').attr('action', url);
        });

        setInterval(function () {
            $('.alert-dismissible').hide()
        }, 3000);
    </script>
@endpush
