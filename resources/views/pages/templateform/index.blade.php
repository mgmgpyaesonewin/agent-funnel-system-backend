@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Website Form Template')
{{-- {{dd($errors->all())}} --}}
@section('content')
<div class="row my-2">
  <div class="col-12">
    <a href="{{route('templateforms.create')}}" class="btn btn-primary float-right">Create</a>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="row">
      @foreach ($templates as $item)
      <div class="card col-12 col-lg-5 col-md-5 ml-1 @if($item->active == 1) border-warning @endif">
        <div class="card-body">
          <h5 class="card-title">Template Name - {{$item->template_name}}</h5>
          <div class="row">
            @foreach (collect($item)->except('id','template_name','created_at','updated_at')->toArray() as $key =>
            $value)
            @component('fieldcheck',['field'=>$value,'fieldName'=> $key])
            @endcomponent
            @endforeach
          </div>
          <div class="row mt-2">
            <a class="btn btn-primary ml-1" href="{{route('templateforms.edit',$item->id)}}">Edit</a>
            <div class="ml-1">
              <form action="{{route('templateforms.destroy',$item->id)}}" method="post">
                @method('delete')
                <input type="hidden" name="id" value="{{$item->id}}">
                <button class="btn btn-danger">Delete</button>
                @csrf
              </form>
            </div>
            <div class="ml-1">
            @if($item->active == 0)
              <form action="{{url('template/activate/'.$item->id)}}" method="post">
                @csrf
                <button class="btn btn-success">Activate</button>
              </form>
            @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</div>

@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/user-profile.js')) }}"></script>
@endsection