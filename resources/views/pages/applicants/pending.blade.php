@extends('layouts/contentLayoutMaster')

@section('title', 'Pending Applicants')

@section('content')
{{-- Dashboard Analytics Start --}}
<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body text-center">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applicants as $applicant)
                                    <tr>
                                        <th scope="row">{{ $applicant->id}}</th>
                                        <td>{{ $applicant->name }}</td>
                                        <td>{{ $applicant->email }}</td>
                                        <td>{{ $applicant->phone }}</td>
                                        <td>{{ $applicant->age }}</td>
                                        <td>{{ $applicant->status->title }}</td>
                                        <td>
                                            <div class="row mx-0">
                                                <a href="{{ url('/applicants/'.$applicant->id) }}"
                                                    class="btn btn-primary btn-block">View</a>
                                            </div>
                                            <div class="btn-group mt-1">
                                                <button class="btn btn-success"><i class="fa fa-check"
                                                        aria-hidden="true"></i></button>
                                                <button class="btn btn-danger"><i class="fa fa-times"
                                                        aria-hidden="true"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $applicants->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection