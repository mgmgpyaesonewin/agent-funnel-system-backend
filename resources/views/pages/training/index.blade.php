@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Trainings Information')

@section('content')
  @include('layouts._flash-message')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="d-flex">
              <div class="ml-auto">
                <a href="{{url('trainings/create')}}" class="btn btn-primary">Create</a>
              </div>
            </div>

            <table class="table table-striped table-bordered">
              <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Total Assigned</th>
                <th scope="col">Total Completed</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($trainings as $data)
                <tr>
                  <th scope="row">{{$data->id}}</th>
                  <td class="">{{$data->name}}</td>
                  <td class="">
                    {{ $data->getTrainingTotalAssigned() }}
                  </td>
                  <td class="">{{$data->applicants->count()}}</td>
                  <td>
                    @if ($data->enable == 1)
                      <h4><span class="badge badge-pill badge-success">Enable</span></h4>
                    @else
                      <h4><span class="badge badge-pill ">Disable</span></h4>
                    @endif
                  </td>
                  <td class="d-flex">
                    <a href="{{ url('training/export/'.$data->id)}}" class="btn btn-info mr-1">Export</a>
                    <a href="{{route('trainings.edit',$data->id)}}" class="btn btn-warning mr-1">Edit</a>
                    <form method="POST" action="{{route('trainings.destroy',$data->id)}}">
                      @method('delete')
                      @csrf
                      <button class="btn btn-outline-danger">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="justify-content-center">
              {{ $trainings->links() }}
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
