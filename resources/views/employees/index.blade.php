@extends('layouts.main')

@section('content')
    <div id="app">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <example-component></example-component>
{{--                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>#</th>--}}
{{--                            <th>Name</th>--}}
{{--                            <th>Country Code</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}

{{--                        @forelse($states as $state)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $loop->iteration }}</td>--}}
{{--                                <td>{{ $state->name }}</td>--}}
{{--                                <td>{{ $state->country->country_code }}</td>--}}
{{--                                <td>--}}
{{--                                    <button class="btn btn-primary btn-circle btn-sm editModal" data-toggle="modal"--}}
{{--                                            data-target="#editModal" data-url="{{route('states.update', $state)}}" data-name="{{ $state->name }}" data-country_id="{{ $state->country_id }}">--}}
{{--                                        <i class="fas fa-edit"></i>--}}
{{--                                    </button>--}}
{{--                                    <button class="btn btn-danger btn-circle btn-sm deleteModal" data-toggle="modal"--}}
{{--                                            data-target="#deleteModal" data-url="{{route('states.destroy', $state)}}">--}}
{{--                                        <i class="fas fa-trash"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                        @endforelse--}}

{{--                        </tbody>--}}
{{--                    </table>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
