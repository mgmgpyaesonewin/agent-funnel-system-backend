@extends('layouts/contentLayoutMaster')

@section('title', 'Net Promoter Score Analysis')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/pages/dashboard-analytics.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/pages/card-analytics.css')) }}">

<style>
  .select--shadow {
    border: none !important;
    box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .14);
    border-radius: 5px;
  }

  .row--margin--disable {
    margin-left: 0px;
    margin-right: 0px;
  }
</style>
@endsection

@section('content')
{{-- Dashboard Analytics Start --}}
<section>
  <div class="row" id="table-hover-animation">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">User: <code class="highlighter-rouge">{{ request()->route()->parameters['id'] }}</code>
          </h4>
        </div>
        <div class="card-content">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover-animation mb-0">
                <thead>
                  <tr>
                    <th scope="col">Project ID</th>
                    <th scope="col">Score</th>
                    <th scope="col">Option</th>
                    <th scope="col">Feedback</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($history->scores as $record)
                  <tr>
                    <th scope="row">{{ $record->project_id }}</th>
                    <td>{{ $record->score }}</td>
                    <td>{{ $record->option->value ?? 'Not Avilable' }}</td>
                    <td>{{ $record->option_feedback }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>

<script src="{{ asset(mix('js/scripts/popover/popover.js')) }}"></script>
@endsection