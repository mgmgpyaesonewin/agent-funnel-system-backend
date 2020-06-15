@extends('layouts/contentLayoutMaster')

@section('title', 'Pending Applicants')

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('content')
<div id="user-profile" class="mb-4">
    <div class="row">
        <div class="col-12">
            <div class="profile-header mb-2">
                <div class="relative">
                    <div class="cover-container">
                        <img class="img-fluid bg-cover rounded-0 w-100"
                            src="{{ asset('images/profile/user-uploads/cover.jpg') }}" alt="User Profile Image">
                    </div>
                    <div class="profile-img-container d-flex align-items-center justify-content-between">
                        <img src="{{ asset('images/profile/user-uploads/user-13.jpg') }}"
                            class="rounded-circle img-border box-shadow-1" alt="Card image">
                        <div class="float-right">
                            <button type="button" class="btn btn-icon btn-icon rounded-circle btn-primary">
                                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center profile-header-nav">
                    <nav class="navbar navbar-expand-sm w-100 pr-0">
                        <button class="navbar-toggler pr-0" type="button" data-toggle="collapse"
                            data-target="navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="feather icon-align-justify"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav justify-content-around w-75 ml-sm-auto">
                                <li class="nav-item px-sm-0">
                                    <a href="#" class="nav-link font-small-3">Information</a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#" class="nav-link font-small-3">Education</a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#" class="nav-link font-small-3">Experience</a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#" class="nav-link font-small-3">Member</a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#" class="nav-link font-small-3">Questions</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="profile-info">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>About</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Name:</h6>
                            <p class="col-md-6">{{ $applicant->name }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Phone:</h6>
                            <p class="col-md-6">{{ $applicant->phone }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Email:</h6>
                            <p class="col-md-6">{{ $applicant->email }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Gender:</h6>
                            <p class="col-md-6">{{ $applicant->gender }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Location</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-1 row">
                            <h6 class="col-md-4">NRC:</h6>
                            <p class="col-md-6">{{ $applicant->nrc }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">DOB:</h6>
                            <p class="col-md-6">{{ $applicant->dob }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Address:</h6>
                            <p class="col-md-6">{{ $applicant->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Education</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($applicant->education as $education)
                            <div class="col-md-1 pl-1">
                                <i class="fa fa-circle primary"></i>
                            </div>
                            <div class="col-md-11">
                                <p>{{ $education['degree'] }}</p>
                                <p>{{ $education['university'] }}, {{ $education['graduated_year'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Experience</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($applicant->working_experience as $working_experience)
                            <div class="col-md-1 pl-1">
                                <i class="fa fa-circle primary"></i>
                            </div>
                            <div class="col-md-11">
                                <p>{{ $working_experience['title'] }}</p>
                                <p>{{ $working_experience['company'] }}</p>
                                <p>{{ $working_experience['start_date'] }} - {{ $working_experience['end_date'] }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>ChateSat Member Section</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-1 row">
                            <h6 class="col-md-8">ChateSat Freelancer:</h6>
                            <p class="col-md-4">{{ $applicant->is_chatesat_freelancer }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-8">Referral Code:</h6>
                            <p class="col-md-4">{{ $applicant->referral_code }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Questions</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-1 row">
                            <h6 class="col-md-10">DNA Test, Webinar တက်ဖို့ အဆင်ပြေလား</h6>
                            <p class="col-md-2">{{ $applicant->is_chatesat_freelancer }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-10">Training 2 months တက်ဖို့ အဆင်ပြေလား</h6>
                            <p class="col-md-2">{{ $applicant->is_training_available }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-10">Certified ဖြစ်ပီး Prudential နဲ့ အနည်းဆုံး 3လ လက်တွဲဖို့ အဆင်ပြေ လား
                            </h6>
                            <p class="col-md-2">{{ $applicant->is_prudential_available }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="buy-now">
        <button class="btn btn-success waves-effect waves-light mr-2">Approve</button>
        <button class="btn btn-danger waves-effect waves-light">Reject</button>
    </div>
</div>
@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/user-profile.js')) }}"></script>
@endsection