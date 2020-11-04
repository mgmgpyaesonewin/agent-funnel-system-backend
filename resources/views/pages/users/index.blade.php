@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Users Information')

@section('content')
@include('layouts._flash-message')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ url('/users') }}" method="get">
                        <div class="d-flex">
                            <div class="px-2">
                                <fieldset class="form-group">
                                    <label for="name">User Name</label>
                                    <input type="text" name="name" placeholder="User Name" class="form-control"
                                        value="{{ app('request')->input('name') }}">
                                </fieldset>
                            </div>
                            <div class="px-2">
                                <fieldset class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" name="email" placeholder="Email" class="form-control"
                                        value="{{ app('request')->input('email') }}">
                                </fieldset>
                            </div>
                            <div class="px-2">
                                <fieldset class="form-group">
                                    <label for="partner">Partner Company</label>
                                    <input type="text" name="partner" placeholder="Partner Company Name"
                                        class="form-control" value="{{ app('request')->input('partner') }}">
                                </fieldset>
                            </div>
                            <div class="px-2">
                                <div class="row mt-2">
                                    <button type="submit" class="btn btn-primary"> Search </button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">UTM</th>
                                    <th scope="col">Partner</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Assigend BDM</th>
                                    <th scope="col">Assigend MA</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td class="">{{$user->name}}</td>
                                    <td class="">{{$user->email}}</td>
                                    <td class="">
                                        <div class="d-flex">
                                            <span>
                                                {{ $user->utm_source }}
                                            </span>
                                            <v-copy-clipboard-btn class-css="btn btn-sm"
                                                text="{{ env('FRONT_END_URL').'/register?utm_source='.$user->utm_source }}">
                                            </v-copy-clipboard-btn>
                                        </div>
                                    </td>
                                    <td class="">{{ $user->partner->company_name ?? '-' }}</td>
                                    <td class="">{{$user->role}}</td>
                                    <td>
                                        <div class="badge badge-pill badge-primary">
                                            @if($user->is_ma === 1)
                                                {{ $user->getParent()->name }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->is_bdm === 1)
                                            @foreach ($user->getMaChildren() as $ma_user)
                                                <div class="badge badge-pill badge-info">
                                                    {{ $ma_user->name }}
                                                </div>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a href="{{route('users.edit',$user->id)}}"
                                            class="btn btn-warning mr-4">Edit</a>
                                        <form method="POST" action="{{route('users.destroy',$user->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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