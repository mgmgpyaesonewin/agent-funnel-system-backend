@extends('layouts/contentLayoutMaster')

@section('title', 'Applicants Detail Information')

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('content')
<div id="user-profile" class="mb-4">
    <div class="row">
        <div class="col-12">
            <div class="profile-header mb-2">
                <div class="relative">
                    <div class="cover-container d-none d-sm-block"
                        style="width: 100%; height: 5rem; background-color: var(--secondary);">
                        <h3 class="text-center text-primary pt-1">Applicant Details</3>
                    </div>
                    <div class="profile-img-container d-flex align-items-center justify-content-between">
                        <img src="https://dummyimage.com/80x80/ed1c4/fff.png&text={{ $applicant->name[0] }}"
                            class="rounded-circle img-border box-shadow-1" alt="Card image">

                        <div class="float-right">
                            <a href="{{ url('/applicant/export/excel/'.$applicant->id) }}" title="Download Excel"
                                class="btn btn-icon btn-icon rounded-circle btn-primary">
                                <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/applicant/export/pdf/'.$applicant->id) }}" title="Download PDF"
                                class="btn btn-icon btn-icon rounded-circle btn-primary">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
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
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section id="profile-info">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if($applicant->current_status != '')
                                <h5 style="color: #606060; font-weight: 500;"><b>Current Status</b> :
                                    <span class="badge badge-info">{{ strtoupper($applicant->current_status)}}</span>
                                </h5>
                                @endif
                                <h5 style="color: #606060; font-weight: 500;"><b>Assign to</b> :
                                    @if($applicant->assign_admin_id != '')
                                    {{ $applicant->admin->name}} |
                                    @endif

                                    @if($applicant->assign_bdm_id != '')
                                    {{ $applicant->bdm->name}} |
                                    @endif

                                    @if($applicant->assign_ma_id != '')
                                    {{ $applicant->ma->name}}
                                    @endif
                                </h5>

                                @if($applicant->utm_source != '')
                                <h5 style="color: #606060; font-weight: 500;"><b>UTM Source</b> :
                                    {{ $applicant->utm_source}}
                                </h5>
                                @endif
                            </div>
                            <div class="col-md-6">

                                @if($applicant->temp_id != '')
                                <h4 style="color: #606060; font-weight: 600;">Temporary ID :
                                    <span class="badge badge-primary">{{ $applicant->temp_id}}</span>
                                </h4>
                                @endif
                                @if($applicant->temp_id != '')
                                <h4 style="color: #606060; font-weight: 600;">Agent ID :
                                    {{ $applicant->agent_code}}
                                </h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>About</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
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
                            <h6 class="col-md-4">DOB:</h6>
                            <p class="col-md-6">{{ $applicant->dob }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Gender:</h6>
                            <p class="col-md-6">{{ $applicant->gender }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Marital Status:</h6>
                            <p class="col-md-6">{{ $applicant->married }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Highest Qualification:</h6>
                            <p class="col-md-6">{{ $applicant->education }}</p>
                        </div>
                        <div class="mt-1 row">
                            <div class="col-md-12">
                                @if(!empty($applicant->certificate))
                                <img src="{{ asset('storage/'.$applicant->certificate) }}"
                                    style="width: 100%; max-width: 300px; height: auto;" />
                                @else
                                <v-certificate-file-upload applicant-uuid="{{ $applicant->uuid }}">
                                </v-certificate-file-upload>
                                @endif
                            </div>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">NRC:</h6>
                            <div class="col-md-6">
                                <p>{{ $applicant->nrc }}</p>
                                <div>
                                    <v-info-button css-class="btn btn-outline-primary btn-sm"
                                        url={{ url('/storage/'.$applicant->nrc_front_img) }}>
                                        <i class="fa fa-id-card-o" aria-hidden="true"></i> Front
                                    </v-info-button>
                                    <v-info-button css-class="btn btn-outline-primary btn-sm"
                                        url={{ url('/storage/'.$applicant->nrc_back_img) }}>
                                        <i class="fa fa-id-card-o" aria-hidden="true"></i> Back
                                    </v-info-button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Address:</h6>
                            <p class="col-md-6">{{ $applicant->address }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">State/Region:</h6>
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
                            <h6 class="col-md-4">Citizenship:</h6>
                            <p class="col-md-6">{{ ($applicant->myanmar_citizen == '1' ? 'Myanmar' : 'Other') }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Race:</h6>
                            <p class="col-md-6">{{ $applicant->race }}</p>
                        </div>


                        @php $infos = json_decode( $applicant->additional_info, true ); @endphp
                        @if($infos)
                        <hr />
                        <div class="card-header pl-0">
                            <h4>Additional Info</h4>
                        </div>
                        @foreach ($infos as $info)
                        @if(isset($info['value']))
                        <div class="mt-1 row">
                            <h6 class="col-md-4">{{ $info['key'] }} :</h6>
                            <p class="col-md-6">{{ $info['value'] }}</p>
                        </div>
                        @endif
                        @endforeach
                        @endif

                        <hr />
                        <div class="card-header pl-0">
                            <h4>Attachments</h4>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Payment:</h6>
                            <div>
                                @if($applicant->payment)
                                <v-info-button css-class="btn btn-outline-primary btn-sm"
                                    url={{ url('/storage/'.$applicant->payment) }}>
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i> View Payment
                                </v-info-button>
                                @endif
                            </div>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">License:</h6>
                            <div>
                                @if($applicant->license_photo_1)
                                {{ $applicant->license_no }} <br>
                                <v-info-button css-class="btn btn-outline-primary btn-sm"
                                    url={{ url('/storage/'.$applicant->license_photo_1) }}>
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i> View License
                                </v-info-button>
                                @endif
                            </div>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Contract:</h6>
                            <div>
                                @if(count($applicant->contracts) > 1)
                                @foreach($applicant->contracts as $contract)
                                Version {{ $contract->version  }} :
                                <v-info-button css-class="btn btn-outline-primary btn-sm"
                                    url={{ url('/storage/'.$contract->pdf) }}>
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i> View Contract
                                </v-info-button> <br>
                                @endforeach
                                @else
                                @if($applicant->contracts()->latest()->first())
                                <v-info-button css-class="btn btn-outline-primary btn-sm"
                                    url={{ url('/storage/'.$applicant->contracts()->latest()->first()->pdf) }}>
                                    <i class="fa fa-id-card-o" aria-hidden="true"></i> View Contract
                                </v-info-button>
                                @endif
                                @endif
                            </div>
                        </div>

                        <hr />
                        <div class="card-header pl-0">
                            <h4>Bank Information</h4>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Account Name</h6>
                            <p class="col-md-6">{{ $applicant->bank_account_name }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Bank Acoount No.</h6>
                            <p class="col-md-6">{{ $applicant->bank_account_no }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Bank Name</h6>
                            <p class="col-md-6">{{ $applicant->banK_name }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Bank Branch Name</h6>
                            <p class="col-md-6">{{ $applicant->bank_branch_name }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Swift Code</h6>
                            <p class="col-md-6">{{ $applicant->swift_code }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>B.O.P Sessions</h4>
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach ($applicant->bop_sessions as $session)
                                    <li>
                                        {{ $session->title }} ({{ $session->getDate().' '.$session->getTime() }})
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Training -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Training Details</h4>
                            </div>
                            <div class="card-body">
                                @if($applicant->e_learning != '')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">E-learning URL</h6>
                                    <p class="col-md-8">
                                        {{$applicant->e_learning}}
                                    </p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Username</h6>
                                    <p class="col-md-8">
                                        {{$applicant->username}}
                                    </p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Password</h6>
                                    <p class="col-md-8">
                                        {{$applicant->password}}
                                    </p>
                                </div>
                                <hr>
                                @endif
                                <div class="card-header pt-0">
                                    <h5>Progress</h5>
                                </div>
                                <ul>
                                    @foreach ($trainings as $module)
                                    <li>
                                        {{ $module->name }}
                                        @if ($applicant->trainings->contains('id', $module->id))
                                        <span>
                                            ( <span class="text-success">
                                                <i class="fa fa-check" aria-hidden="true"></i>
                                            </span> )
                                        </span>
                                        @else
                                        <span>( <span class="text-danger"><i class="fa fa-times"
                                                    aria-hidden="true"></i></span>
                                            )</span>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @if($applicant->exam_date != '')
                                <hr>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Exam Date</h6>
                                    <p class="col-md-8">
                                        {{$applicant->exam_date}}
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Log -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Activity Log</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($activities as $row)
                                <!-- Lead -->
                                @if($row->status_id == '1' && $row->current_status == 'lead')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Registered</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @elseif($row->status_id == '1' && $row->current_status == 'pre_filter')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Lead Stage</h6>
                                    <p class="col-md-6">
                                        Approved by {{$applicant->created_at ?? '-'}}
                                    </p>
                                </div>
                                @elseif($row->status_id == '4' && $row->current_status == 'lead')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Lead Stage</h6>
                                    <p class="col-md-8">
                                        Rejected by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif


                                <!-- Background Check -->
                                @if($row->status_id == '1' && $row->current_status == 'pru_dna_test')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Background Check Stage</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @elseif($row->status_id == '4' && $row->current_status == 'pre_filter')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Background Check Stage</h6>
                                    <p class="col-md-8">
                                        Rejected by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif

                                <!-- PRUDNA  -->
                                @if($row->status_id == '1' && $row->current_status == 'pmli_filter')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">PruDNA Stage</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @elseif($row->status_id == '4' && $row->current_status == 'pru_dna_test')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">PruDNA Stage</h6>
                                    <p class="col-md-8">
                                        Rejected by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif
                                <!-- PMLI  -->
                                @if($row->status_id == '1' && $row->current_status == 'pmli_filter')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">PMLI Filter Stage</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @elseif($row->status_id == '4' && $row->current_status == 'pmli_filter')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">PMLI Filter Stage</h6>
                                    <p class="col-md-8">
                                        Rejected by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif

                                <!-- Training  -->
                                @if($row->status_id == '3' && $row->current_status == 'pmli_filter')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Training Stage</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif

                                <!-- Certification  -->
                                @if($row->status_id == '1' && $row->current_status == 'onboard')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Certification Stage (Pass)</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @elseif($row->status_id == '4' && $row->current_status == 'certification')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Certification Stage</h6>
                                    <p class="col-md-8">
                                        Rejected by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif

                                <!-- Onboarding  -->
                                @if($row->status_id == '4' && $row->current_status == 'onboard')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Onboarding Stage</h6>
                                    <p class="col-md-8">
                                        Rejected by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif

                                <!-- Active Agent  -->
                                @if($row->status_id == '8')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Active Agent</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif

                                <!-- InActive Agent  -->
                                @if($row->status_id == '9')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Inactive Agent</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif

                                <!-- Active Agent  -->
                                @if($row->status_id == '10')
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Ceased Association</h6>
                                    <p class="col-md-8">
                                        Approved by {{$row->name ?? '-'}} on {{$row->created_at ?? '-'}}
                                    </p>
                                </div>
                                @endif
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Declaration</h4>
                    </div>
                    <div class="card-body">
                        <div class="mt-1 row">
                            <h6 class="col-md-6">Agree to Terms & Condition:</h6>
                            <p class="col-md-6">{{  $applicant->accept_t_n_c == 1 ? 'Yes' : '-' }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-6">Agree that the information provided is true and correct :</h6>
                            <p class="col-md-6">{{ $applicant->correct_info == '1' ? 'Yes' : '-' }}</p>
                        </div>
                    </div>
                    <hr>
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
                            <h6 class="col-md-4">Occupation:</h6>
                            <p class="col-md-6">{{ $applicant->spouse_occupation }}</p>
                        </div>
                        <div class="mt-1 row">
                            <h6 class="col-md-4">Work at:</h6>
                            <p class="col-md-6">{{ $applicant->spouse_company_name }}</p>
                        </div>
                    </div>
                    <hr>

                    <div class="card-header">
                        <h4>Was a staff of Prudential? </h4> @if($applicant->prudential_agency_exp == null ||
                        $applicant->prudential_agency_exp == '') : No @endif
                    </div>
                    @if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                    <div class="card-body">
                        <div class="row">
                            @php $employment = json_decode( $applicant->prudential_agency_exp, true ); @endphp
                            <div class="col-md-11">
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Position:</h6>
                                    <p class="col-md-6">{{ $employment['position'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Department:</h6>
                                    <p class="col-md-6">{{ $employment['department_name']  ?? '-'}}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Start Date:</h6>
                                    <p class="col-md-6">{{ $employment['duration_from_date'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">End Date:</h6>
                                    <p class="col-md-6">{{ $employment['duration_to_date'] ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <hr>

                    <div class="card-header">
                        <h4>Current and past employment details </h4> @if($applicant->employment == null ||
                        $applicant->employment == '') : No Experience
                        @endif
                    </div>

                    @if($applicant->employment != null|| $applicant->employment != '')
                    <div class="card-body">
                        <div class="row">
                            @php $emp = json_decode( $applicant->employment, true ); @endphp
                            @foreach ($emp as $employment)
                            <div class="card-body col-12">
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Company:</h6>
                                    <p class="col-md-6">{{ $employment['company_name'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Address:</h6>
                                    <p class="col-md-6">{{ $employment['address'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Position:</h6>
                                    <p class="col-md-6">{{ $employment['position'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Income:</h6>
                                    <p class="col-md-6">{{ $employment['income'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Industry:</h6>
                                    <p class="col-md-6">{{ $employment['industry_type'] ?? '-' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <hr>

                        <div class="card-header">
                            <h4>Have any selling experience or acted as an agent </h4> @if($applicant->agent_exp == null
                            || $applicant->agent_exp == '') : No @endif
                        </div>

                        @if($applicant->agent_exp != null || $applicant->agent_exp != '')
                        <div class="card-body">
                            <div class="row">
                                @php $agent_exp = json_decode( $applicant->agent_exp, true ); @endphp
                                <div class="card-body">
                                    <div class="mt-1 row">
                                        <h6 class="col-md-4">Position:</h6>
                                        <p class="col-md-6">{{ $agent_exp['position'] ?? '-' }}</p>
                                    </div>
                                    <div class="mt-1 row">
                                        <h6 class="col-md-4">Address:</h6>
                                        <p class="col-md-6">{{ $agent_exp['address'] ?? '-' }}</p>
                                    </div>
                                    <div class="mt-1 row">
                                        <h6 class="col-md-4">Compay Name:</h6>
                                        <p class="col-md-6">{{ $agent_exp['company_name'] ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <hr>

                            <div class="card-header">
                                <h4>Family member as an agent or a staff of Prudential? </h4>
                                @if($applicant->family_agent == null || $applicant->family_agent == '') : No @endif
                            </div>

                            @if($applicant->family_agent != null || $applicant->family_agent != '')
                            <div class="card-body">
                                @php $family_agent = json_decode( $applicant->family_agent, true ); @endphp
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Name:</h6>
                                    <p class="col-md-6">{{ $family_agent['name'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Position:</h6>
                                    <p class="col-md-6">{{ $family_agent['position'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Agent ID:</h6>
                                    <p class="col-md-6">{{ $family_agent['agent_code'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">Relation:</h6>
                                    <p class="col-md-6">{{ $family_agent['relation'] ?? '-' }}</p>
                                </div>
                                <div class="mt-1 row">
                                    <h6 class="col-md-4">NRC:</h6>
                                    <p class="col-md-6">{{ $family_agent['nrc'] ?? '-' }}</p>
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