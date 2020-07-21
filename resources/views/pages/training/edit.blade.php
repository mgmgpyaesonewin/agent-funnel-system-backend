@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Create Training')
{{-- {{dd($errors->all())}} --}}
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form action="{{route('trainings.update',$training->id)}}" method="POST" >
                        @csrf
                        @method('put')
                        <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                        <input type="text" value="{{$training->name}}" class="form-control" name="name" aria-describedby="emailHelp">
                        @error('name')
                        <span class="text-danger">                          
                            {{$errors->get('name')[0]}}
                        </span>
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