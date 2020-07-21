@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title')
    <div class="">Training List</div>
    @endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="d-flex">  <div class="ml-auto">
                        <a href="{{url('trainings/create')}}" class="btn btn-primary">Create</a>
                    </div></div>
                  
                    <table class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($trainings as $data)
                            <tr>
                            <th scope="row">{{$data->id}}</th>
                                <td class="">{{$data->name}}</td>
                              <td class="d-flex">
                              <a href="{{route('trainings.edit',$data->id)}}" class="btn btn-primary mr-4">Edit</a>
                              <form method="POST" action="{{route('trainings.destroy',$data->id)}}">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Delete</button></td>
                            </form>    
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
               
            </div>
        </div>
    </div>
</div>

@endsection
@section('page-script')
{{-- Page js files --}}
@endsection