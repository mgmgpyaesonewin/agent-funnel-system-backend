@extends('layouts/contentLayoutMaster')

@section('title', 'BOP Sessions')

@section('content')
@include('layouts._flash-message')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body table-responsive">
                    <div class="d-flex">
                        <div class="ml-auto">
                            <a href="{{url('sessions/create')}}" class="btn btn-primary">Create</a>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="d-flex">
                                <th class="col-1">#</th>
                                <th class="col-2">Title</th>
                                <th class="col-2">Date</th>
                                <th class="col-2">Time</th>
                                <th class="col-3">URL</th>
                                <th class="col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sessions as $session)
                            <tr class="d-flex">
                                <th class="col-1">{{ $session->id }}</th>
                                <td class="col-2">{{ $session->title }}</td>
                                <td class="col-2">{{ $session->session }}</td>
                                <td class="col-2">{{ $session->session }}</td>
                                <td class="col-3">{{ $session->url }}</td>
                                <td class="col-2">
                                    <div class="row">
                                        <a href="{{route('sessions.edit',$session->id)}}"
                                            class="btn btn-warning mr-1">Edit</a>
                                        <form method="POST" action="{{route('sessions.destroy',$session->id)}}">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-outline-danger">Delete</button>
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