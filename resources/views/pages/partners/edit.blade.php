@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Edit Partners')
{{-- {{dd($errors->all())}} --}}
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{route('partners.update',$partner->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" name="company_name"
                                value="{{$partner->company_name}}" />
                            @error('name')
                            <span class="text-danger">{{ $errors->get('company_name')[0] }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Partner Name</label>
                            <input type="text" class="form-control" name="pic_name" value="{{$partner->pic_name}}" />
                            @error('name')
                            <span class="text-danger">{{ $errors->get('pic_name')[0] }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Partner Phone</label>
                            <input type="text" class="form-control" name="pic_phone" value="{{$partner->pic_phone}}" />
                            @error('name')
                            <span class="text-danger">{{ $errors->get('pic_phone')[0] }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Partner Email</label>
                            <input type="text" class="form-control" name="pic_email" value="{{$partner->pic_email}}" />
                            @error('name')
                            <span class="text-danger">{{ $errors->get('pic_email')[0] }}</span>
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