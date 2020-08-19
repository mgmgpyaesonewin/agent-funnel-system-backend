@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Create User')
{{-- {{dd($errors->all())}} --}}
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{url('users')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
                            @error('name')
                            <span class="text-danger"> {{$errors->first('name')}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="email" aria-describedby="emailHelp">
                            @error('email')
                            <span class="text-danger"> {{$errors->first('email')}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" class="form-control" name="password" aria-describedby="emailHelp">
                            @error('password')
                            <span class="text-danger"> {{$errors->first('password')}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <select class="form-control" name="role">
                                <option value="is_admin">Admin</option>
                                <option value="is_bdm">BDM</option>
                                <option value="is_ma">MA</option>
                            </select>
                            @error('partner_id')
                            <span class="text-danger">{{ $errors->first('partner_id') }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Partner</label>
                            <select class="form-control" name="partner_id">
                                <option value="">None</option>
                                @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->company_name }}</option>
                                @endforeach
                            </select>
                            @error('partner_id')
                            <span class="text-danger">{{ $errors->first('partner_id') }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/user-profile.js')) }}"></script>
@endsection