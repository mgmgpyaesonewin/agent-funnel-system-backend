@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('content')
<div id="user-profile" class="mb-4">
    <div class="row">
        <div class="col-12">
            <div class="profile-header mb-2">
                <div class="relative">
                    <div class="cover-container" style="width: 100%; height: 5rem; background-color: var(--secondary);">
                        <h3 style="padding-top: 1.5rem;
    padding-left: 19rem;
    color: white;
                    font-weight: 600;">Applicant's Detail {{ $applicant->temp_id }}</h3>
                    </div>
                    <div class="profile-img-container d-flex align-items-center justify-content-between">
                        <img src="{{ asset('images/profile/user-uploads/user-13.jpg') }}"
                            class="rounded-circle img-border box-shadow-1" alt="Card image">
                        <div class="float-right">
                            <a href="{{ url('/applicant/export/'.$applicant->id) }}"
                                class="btn btn-icon btn-icon rounded-circle btn-primary">
                                <i class="fa fa-cloud-download" aria-hidden="true"></i>
                            </a>
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
                                    <a href="#" class="nav-link font-small-3">Certification</a>
                                </li>
                                <li class="nav-item px-sm-0">
                                    <a href="#" class="nav-link font-small-3">History</a>
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
                            <h6 class="col-md-4">Prefered Name:</h6>
                            <p class="col-md-6">{{ $applicant->preferred_name }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Phone:</h6>
                            <p class="col-md-6">{{ $applicant->phone }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Secondary Phone:</h6>
                            <p class="col-md-6">{{ $applicant->secondary_phone }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Email:</h6>
                            <p class="col-md-6">{{ $applicant->email }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Gender:</h6>
                            <p class="col-md-6">{{ $applicant->gender }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Marital Status:</h6>
                            <p class="col-md-6">{{ ($applicant->married == '1' ? 'Married' : 'Single') }}</p>
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
                            <v-info-button css-class="btn btn-info" url={{ $applicant->license_photo_1 }}>
                                <i class="fa fa-id-card-o" aria-hidden="true"></i> Front
                            </v-info-button>
                            <v-info-button css-class="btn btn-info" url={{ $applicant->license_photo_1 }}>
                                <i class="fa fa-id-card-o" aria-hidden="true"></i> Back
                            </v-info-button>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">DOB:</h6>
                            <p class="col-md-6">{{ $applicant->dob }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Address:</h6>
                            <p class="col-md-6">{{ $applicant->address }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">City:</h6>
                            <p class="col-md-6">
                                {{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}
                            </p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Township:</h6>
                            <p class="col-md-6">
                                {{ DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-'}}
                            </p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Myanmar Citizen:</h6>
                            <p class="col-md-6">{{ ($applicant->myanmar_citizen == '1' ? 'Yes' : 'No') }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Race:</h6>
                            <p class="col-md-6">{{ $applicant->race }}</p>
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
                            <div class="col-md-1 pl-1">
                                <i class="fa fa-circle primary"></i>
                            </div>
                            <div class="col-md-11">
                                {{ $applicant->education }}
                            </div>
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
                            @if($applicant->employment != null)
                            @php $employment = json_decode( $applicant->employment, true ); @endphp
                            @foreach ($employment as $exp)
                            <div class="col-md-1 pl-1">
                                <i class="fa fa-circle primary"></i>
                            </div>
                            <div class="col-md-11">
                                <p>{{ $exp['position'] }}</p>
                                <p>{{ $exp['company_name'] }}</p>
                                <p>{{ $exp['duration'] }}</p>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Conflict of Interest</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Spouse Name:</h6>
                            <p class="col-md-6">{{ $applicant->spouse_name }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Spouse NRC:</h6>
                            <p class="col-md-6">{{ $applicant->spouse_nrc }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Occupa-tion:</h6>
                            <p class="col-md-6">{{ $applicant->spouse_occupation }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Work at:</h6>
                            <p class="col-md-6">{{ $applicant->spouse_company_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Agent Exp</h4>
                    </div>
                    @if($applicant->agent_exp != null)
                    @php $agent_exp = json_decode( $applicant->agent_exp, true ); @endphp
                    <div class="card-body">
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Company:</h6>
                            <p class="col-md-6">{{ $agent_exp['company_name'] }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Address:</h6>
                            <p class="col-md-6">{{ $agent_exp['address'] }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Position:</h6>
                            <p class="col-md-6">{{ $agent_exp['position'] }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Family Agent</h4>
                    </div>
                    @if($applicant->family_agent != null)
                    @php $family_agent = json_decode( $applicant->family_agent, true ); @endphp
                    {{-- {{ dd($family_agent) }} --}}
                    <div class="card-body">
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Name:</h6>
                            <p class="col-md-6">{{ $family_agent['name'] }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Position:</h6>
                            <p class="col-md-6">{{ $family_agent['position'] }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Agent Code:</h6>
                            <p class="col-md-6">{{ $family_agent['agent_code'] }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Relation:</h6>
                            <p class="col-md-6">{{ $family_agent['relation'] }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">NRC:</h6>
                            <p class="col-md-6">{{ $family_agent['nrc'] }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/user-profile.js')) }}"></script>
@endsection