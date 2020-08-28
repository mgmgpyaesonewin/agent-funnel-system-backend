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
                    <form action="{{ route('users.update',$user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" name="name" aria-describedby="emailHelp"
                                value="{{ $user->name }}">
                            @error('name')
                            <span class="text-danger"> {{$errors->first('name')}}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" class="form-control" name="email" aria-describedby="emailHelp"
                                value="{{ $user->email }}">
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
                            <select class="form-control" name="role" onchange="showDiv()" id="role">
                                <option value="is_admin" @if($user->is_admin == 1) selected @endif>Admin</option>
                                <option value="is_bdm" @if($user->is_bdm == 1) selected @endif>BDM</option>
                                <option value="is_ma" @if($user->is_ma == 1) selected @endif>MA</option>
                                <option value="partner" @if($user->partner_id != null) selected @endif>Partner</option>
                            </select>
                            @error('role')
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                            @enderror
                        </div>
                        @if($user->partner_id != null)
                        <div class="form-group" id="partner">
                            <label for="exampleInputEmail1">Partner</label>
                            <select class="form-control" name="partner_id">
                                <option value="">None</option>
                                @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}" @if($user->partner_id === $partner->id) selected @endif>
                                    {{ $partner->company_name }}</option>
                                @endforeach
                            </select>
                            @error('partner_id')
                            <span class="text-danger">{{ $errors->first('partner_id') }}</span>
                            @enderror
                        </div>
                        @endif

                        @if($user->user_id != null && $user->is_ma == 1)
                        <div class="form-group">
                            <label for="exampleInputEmail1">BDM</label>
                            <select class="form-control" name="user_id">
                                <option value="">None</option>
                                @foreach ($bdm_list as $item)
                                <option value="{{ $item->id }}" @if($item->id === $user->user_id) selected @endif>
                                    {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="text-danger">{{ $errors->first('user_id') }}</span>
                            @enderror
                        </div>
                        @endif
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