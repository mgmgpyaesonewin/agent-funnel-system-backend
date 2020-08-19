@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Users Information')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="ml-auto">
                            <a href="{{url('users/create')}}" class="btn btn-primary">Create</a>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Partner</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td class="">{{$user->name}}</td>
                                <td class="">{{$user->email}}</td>
                                <td class="">{{ $user->partner->company_name ?? 'Site Admin' }}</td>
                                <td class="">{{$user->role}}</td>
                                <td class="d-flex">
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary mr-4">Edit</a>
                                    <form method="POST" action="{{route('users.destroy',$user->id)}}">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('page-script')
{{-- Page js files --}}
@endsection