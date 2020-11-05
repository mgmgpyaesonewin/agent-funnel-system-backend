@extends('layouts/contentLayoutMaster')

@section('title', 'Business Opportunity Presentation Sessions')

@section('content')
@include('layouts._flash-message')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body table-responsive">
                    <div class="d-flex mb-2">
                        <div class="ml-auto">
                            <a href="{{url('sessions/create')}}" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                    @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p class="mb-0">{{ session('message') }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="max-width: 8rem;">Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th style="max-width: 10rem;">URL</th>
                                <th scope="col">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                            <tr>
                                <th>{{ $session->id }}</th>
                                <td style="max-width: 8rem;">{{ $session->title }}</td>
                                <td>{{ $session->getDate() }}</td>
                                <td>{{ $session->getTime() }}</td>
                                <td style="max-width: 10rem;">
                                    <a href="{{ $session->url }}" class="alert-link">{{ $session->url }}</a>
                                </td>
                                <td>
                                  @if ($session->enable == 1)
                                    <h4><span class="badge badge-pill badge-success">Enable</span></h4>
                                  @else
                                    <h4><span class="badge badge-pill">Disable</span></h4>
                                  @endif
                                </td>
                                <td>
                                    <div class="row">
                                        <a href="{{route('sessions.edit',$session->id)}}"
                                            class="btn btn-warning mr-1">Edit</a>
                                        <form method="POST" action="{{route('sessions.destroy',$session->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="justify-content-center">
                        {{ $sessions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
