@extends('layouts.contentLayoutMaster')

@section('title')System Configuration @endsection

@section('content')
<form action="{{ url('/setting/update_setting') }}" method="post">
  {{ csrf_field() }}

  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card">
        <div class="card-content">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <span class="float-right">
                <a href="{{ url('setting/applicants/export')}}" class="btn btn-info">Export</a>
              </span>
              Download Applicants Information
            </li>
            <li class="list-group-item">
              <span class="float-right">
                <a href="{{ url('training/export')}}" class="btn btn-warning">Import</a>
              </span>
              Update Applicants Information
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-10">
      @if (session()->has('status'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="mb-0">{{ session('status') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      @endif
      <div class="card">
        <div class="card-content">
          <div class="card-body">
            <h4 class="card-title">Settings</h4>
          </div>

          <div class="form-group row mx-1">
            <label for="inputPassword" class="col-sm-4 col-form-label">Make Applicant Payment Mandatory</label>
            <div class="col-sm-8">
              <div class="custom-control custom-switch custom-switch-success custom-control-inline">
                <input type="checkbox" name="payment_option" class="custom-control-input" id="customSwitch1"
                  onchange="event.preventDefault(); document.getElementById('option-form').submit();" @if($payment=='1'
                  ) checked @endif>
                <label class="custom-control-label" for="customSwitch1">
                </label>
              </div>
            </div>
          </div>
          <HR>
          <div class="card-body">
            <h4 class="card-title">Viber Messages</h4>
          </div>
          @foreach($msg_templates as $temp)
          <div class="form-group row mx-1">
            <label for="inputPassword" class="col-sm-3 col-form-label">
              @switch($temp->meta_key)
              @case('cv_form_msg')
              Full CV Form link (Leads Stage)
              @break

              @case('dna_test_msg')
              PruDNA Test link (Pre-filter)
              @break

              @case('interview_msg')
              Interview Details (PruDNA Filter)
              @break

              @case('payment_msg')
              Ask for payment receipt (PMLI Filter)
              @break

              @case('elearning_msg')
              Send E-Learning link (PMLI Filter)
              @break

              @case('exam_msg')
              Examination date reminder (Training Stage)
              @break

              @case('contract_msg')
              Re-Send Contract (Onboarding Stage)
              @break

              @endswitch
            </label>
            <div class="col-sm-9">
              <textarea class="form-control" id="exampleFormControlTextarea1" name="{{$temp->meta_key}}"
                rows="3">{{$temp->meta_value}}</textarea>
            </div>
          </div>
          @endforeach
          <hr>
          <div class="form-group row mx-1">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</form>
@endsection