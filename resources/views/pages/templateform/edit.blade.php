@extends('layouts/contentLayoutMaster')

{{-- @section('title', 'Applicants Detail Information') --}}

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/pages/users.css')) }}">
@endsection

@section('title', 'Edit Template')
{{-- {{dd($errors->all())}} --}}
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <form action="{{route('templateforms.update',$templateForm->id)}}" method="POST">
            @csrf
            @method('put')
            <div class="row  mb-2">
              <label class="form-check-label" for="template_name">
                Template Name
              </label>
              <input class="form-control" required name="template_name" type="text"
                value="{{$templateForm->template_name}}" id="template_name">
            </div>
            <div class="row">
              <div class="form-check col-4">
                <input class="form-check-input" name="email" {{checkStatus($templateForm->email)}} type="checkbox"
                  value=1 id="email">

                <label class="form-check-label" for="email">
                  Email Field
                </label>
              </div>
              <div class="form-check col-4">
                <input {{checkStatus($templateForm->name)}} class="form-check-input" name="name" type="checkbox" value=1
                  id="Name">
                <label class="form-check-label" for="Name">
                  Name Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->preferred_name)}} name="preferred_name"
                  type="checkbox" value=1 id="preferred_name">
                <label class="form-check-label" for="preferred_name">
                  Preferred Name Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->nrc)}} name="nrc" type="checkbox" value=1
                  id="nrc">
                <label class="form-check-label" for="nrc">
                  NRC Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->nrc_photo)}} name="nrc_photo"
                  type="checkbox" value=1 id="nrc_photo">
                <label class="form-check-label" for="nrc_photo">
                  NRC Photo Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->dob)}} name="dob" type="checkbox" value=1
                  id="dob">
                <label class="form-check-label" for="dob">
                  Date Of Birth Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->gender)}} name="gender" type="checkbox"
                  value=1 id="gender">
                <label class="form-check-label" for="gender">
                  Gender Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->myanmar_citizen)}} name="myanmar_citizen"
                  type="checkbox" value=1 id="myanmar_citizen">
                <label class="form-check-label" for="myanmar_citizen">
                  Check Myanmar Citizen Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->citizenship)}} name="citizenship"
                  type="checkbox" value=1 id="citizenship">
                <label class="form-check-label" for="citizenship">
                  Citizenship Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->race)}} name="race" type="checkbox" value=1
                  id="race">
                <label class="form-check-label" for="race">
                  Race Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->marital_status)}} name="marital_status"
                  type="checkbox" value=1 id="marital_status">
                <label class="form-check-label" for="marital_status">
                  Marital Status Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->address)}} name="address" type="checkbox"
                  value=1 id="address">
                <label class="form-check-label" for="address">
                  Address Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" {{checkStatus($templateForm->city)}} name="city" type="checkbox" value=1
                  id="city">
                <label class="form-check-label" for="city">
                  City Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" name="township" {{checkStatus($templateForm->township)}} type="checkbox"
                  value=1 id="township">
                <label class="form-check-label" for="township">
                  Township Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" name="contact_no" {{checkStatus($templateForm->contact_no)}}
                  type="checkbox" value=1 id="contact_no">
                <label class="form-check-label" for="contact_no">
                  Contact Phone No Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" name="alternate_no" {{checkStatus($templateForm->alternate_no)}}
                  type="checkbox" value=1 id="alternate_no">
                <label class="form-check-label" for="alternate_no">
                  Another Phone No Field
                </label>
              </div>

              <div class="form-check col-4">
                <input class="form-check-input" name="highest_qualification"
                  {{checkStatus($templateForm->highest_qualification)}} type="checkbox" value=1
                  id="highest_qualification">
                <label class="form-check-label" for="highest_qualification">
                  Highest Qualification Field
                </label>
              </div>

              <div class="form-check col-4">
                <input class="form-check-input" name="conflict_interest"
                  {{checkStatus($templateForm->conflict_interest)}} type="checkbox" value=1 id="conflict_interest">
                <label class="form-check-label" for="conflict_interest">
                  Conflict Of Interest Field
                </label>
              </div>
              <div class="form-check col-4">
                <input class="form-check-input" name="term_condition" {{checkStatus($templateForm->term_condition)}}
                  type="checkbox" value=1 id="term_condition">
                <label class="form-check-label" for="term_condition">
                  Term and Condition Field
                </label>
              </div>
            </div>

            <v-template-add-more-input-edit :additional-info='{{ json_encode($templateForm->additional_info) }}'>
            </v-template-add-more-input-edit>
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