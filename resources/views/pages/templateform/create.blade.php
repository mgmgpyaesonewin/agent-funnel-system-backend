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
                    <form action="{{url('templateforms')}}" method="POST" class=" ml-2" >
                        @csrf
                        <div class="row">
                            <div class="form-check col-4">
                                <input class="form-check-input" name="email" type="checkbox" value=1 id="email">
                                <label class="form-check-label" for="email">
                                 Email Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="name" type="checkbox" value=1 id="Name">
                                <label class="form-check-label" for="Name">
                                 Name Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="preferred_name" type="checkbox" value=1 id="preferred_name">
                                <label class="form-check-label" for="preferred_name">
                                 Preferred Name Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="nrc" type="checkbox" value=1 id="nrc">
                                <label class="form-check-label" for="nrc">
                                NRC Field
                                </label>
                              </div>
                            <div class="form-check col-4">
                                <input class="form-check-input" name="nrc_photo" type="checkbox" value=1 id="nrc_photo">
                                <label class="form-check-label" for="nrc_photo">
                                 NRC Photo Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="dob" type="checkbox" value=1 id="dob">
                                <label class="form-check-label" for="dob">
                                 Date Of Birth Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="gender" type="checkbox" value=1 id="gender">
                                <label class="form-check-label" for="gender">
                                    Gender Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="myanmar_citizen" type="checkbox" value=1 id="myanmar_citizen">
                                <label class="form-check-label" for="myanmar_citizen">
                                Check Myanmar Citizen Field
                                </label>
                              </div>
                            <div class="form-check col-4">
                                <input class="form-check-input" name="citizenship" type="checkbox" value=1 id="citizenship">
                                <label class="form-check-label" for="citizenship">
                                 Citizenship Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="race" type="checkbox" value=1 id="race">
                                <label class="form-check-label" for="race">
                                 Race Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="marital_status" type="checkbox" value=1 id="marital_status">
                                <label class="form-check-label" for="marital_status">
                                    Marital Status Field
                                </label>
                              </div>
                              <div class="form-check col-4">
                                <input class="form-check-input" name="address" type="checkbox" value=1 id="address">
                                <label class="form-check-label" for="address">
                                    Address Field
                                </label>
                        </div>
                        <div class="form-check col-4">
                            <input class="form-check-input" name="city" type="checkbox" value=1 id="city">
                                <label class="form-check-label" for="city">
                                City Field
                            </label>
                    </div>
                    <div class="form-check col-4">
                        <input class="form-check-input" name="township" type="checkbox" value=1 id="township">
                            <label class="form-check-label" for="township">
                            Township Field
                        </label>
                </div>
                <div class="form-check col-4">
                    <input class="form-check-input" name="contact_no" type="checkbox" value=1 id="contact_no">
                        <label class="form-check-label" for="contact_no">
                        Contact Phone No Field
                    </label>
                 </div>
                 <div class="form-check col-4">
                    <input class="form-check-input" name="alternate_no" type="checkbox" value=1 id="alternate_no">
                        <label class="form-check-label" for="alternate_no">
                        Another Phone No Field
                    </label>
                 </div>

                 <div class="form-check col-4">
                    <input class="form-check-input" name="highest_qualification" type="checkbox" value=1 id="highest_qualification">
                        <label class="form-check-label" for="highest_qualification">
                            Highest Qualification Field
                    </label>
                 </div>

                 <div class="form-check col-4">
                    <input class="form-check-input" name="conflict_interest" type="checkbox" value=1 id="conflict_interest">
                        <label class="form-check-label" for="conflict_interest">
                            Conflict Of Interest Field
                    </label>
                 </div>
                 <div class="form-check col-4">
                    <input class="form-check-input" name="term_condition" type="checkbox" value=1 id="term_condition">
                        <label class="form-check-label" for="term_condition">
                            Term and Condition Field
                    </label>
                 </div>
                </div>

                        <button type="submit" class="btn btn-primary mt-1">Submit</button>
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