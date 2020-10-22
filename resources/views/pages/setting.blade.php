@extends('layouts.contentLayoutMaster')

@section('title')System Configuration @endsection

@section('content')
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-content">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <span class="float-right">
              <button type="button" class="btn btn-info" onclick='openModal()'>Export</button>
            </span>
            Download Applicants Information
          </li>
          @if (Auth::user()->partner_id =="")
          <li class="list-group-item">
            <span class="float-right">
              <form action="{{ url('setting/applicants/import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <input type="file" name="file" class="form-control">
                  </div>

                  <div class="col-md-3">
                    <button type="submit" class="btn btn-warning">Upload</button>
                  </div>
                  <div class="col-md-3">
                    <a href="{{ url('setting/import_history') }}" class="btn btn-outline-warning px-1">View History</a>
                  </div>
                </div>
              </form>
            </span>
            Update Applicants Information
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>
@if (Auth::user()->partner_id =="")
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
    <form action="{{ url('/setting/update_setting') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
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

            <div class="col-sm-7">
              <label for="inputPassword" class="col-form-label"><strong>
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

                  @case('license_msg')
                  License Information Collection (Certification Stage)
                  @break

                  @case('contract_msg')
                  Re-Send Contract (Onboarding Stage)
                  @break

                  @case('sign_contract_msg')
                  Sign Contract (Onboarding Stage)
                  @break

                  @case('active_contract_msg')
                  Active Contract (Contract & Agent)
                  @break

                  @case('bop_session_msg')
                  Business Opportunity Presentation (BOP Session Stage)
                  @break

                  @endswitch
                </strong></label>
              @php $data = json_decode( $temp->meta_value, true ); @endphp
              <textarea class="form-control" id="exampleFormControlTextarea1" name="{{$temp->meta_key}}"
                rows="5">{{$data['text']}}</textarea>
              <br>
              <label for="inputPassword" class="col-form-label"><strong>Image to insert in above Viber
                  Message</strong></label>
              <input type="file" name="{{$temp->meta_key}}_img" class="form-control" accept="image/*">

            </div>
            <div class="col-sm-5">
              @if(isset($data['image']) && $data['image'] != '')
              <label for="inputPassword" class="col-form-label"><strong>Current Image included in this viber
                  message</strong></label>
              <img class="img-fluid" src="{{ asset('storage/'.$data['image']) }}">
              <br><br>
              <center><a href="{{ url('/setting/remove_viber_img/'.$temp->id) }}" class="btn btn-secondary">Remove
                  Image</a></center>
              @endif
            </div>
          </div>
          <hr>
          @endforeach

          <div class="form-group row mx-1">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
            </div>
          </div>

        </div>
      </div>
  </div>
</div>
@endif
</form>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true"
  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Export Options</h5>
        <button type="button" class="close" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('/setting/applicants/export') }}" method="post" id="export-form">
          {{ csrf_field() }}
          <div class="form-group row mx-1">
            <label for="inputPassword" class="col-sm-4 col-form-label">From</label>
            <div class="col-sm-8">
              <input type="date" name="from">
            </div>
          </div>
          <div class="form-group row mx-1">
            <label for="inputPassword" class="col-sm-4 col-form-label">To</label>
            <div class="col-sm-8">
              <input type="date" name="to">
            </div>
          </div>
          <div class="form-group row mx-1">
            <label for="inputPassword" class="col-sm-4 col-form-label">Type</label>
            <div class="col-sm-8">
              <select name="type" class="form-control">
                <option>-- Choose --</option>
                <option value="audit">For Audit</option>
                <option value="dcms">For DCMS</option>
                <option value="check">For PruDNA/AML Check</option>
                <option value="import">Import Template</option>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
        <button type="submit" class="btn btn-primary" form="export-form">Download</button>
      </div>
    </div>
  </div>
</div>
<div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>
@endsection
<script>
  function openModal() {
    document.getElementById("backdrop").style.display = "block"
    document.getElementById("exampleModal").style.display = "block"
    document.getElementById("exampleModal").className += "show"
}
function closeModal() {
    document.getElementById("backdrop").style.display = "none"
    document.getElementById("exampleModal").style.display = "none"
    document.getElementById("exampleModal").className += document.getElementById("exampleModal").className.replace("show", "")
}
// Get the modal
var modal = document.getElementById('exampleModal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        closeModal()
    }
}
</script>