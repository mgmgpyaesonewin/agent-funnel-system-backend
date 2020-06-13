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
  <div class="row mb-2">
    <form action='' class="form form-vertical">
      <div class="form-body">
        <div class="row mx-sm row--margin--disable">
          <div class="col-3">
            <label for="option">Option</label>
            <select class="form-control select--shadow" name="option" aria-hidden="true">
              <option selected="">Option</option>
              @foreach ($options as $opt)
              <option value="{{$opt->id}}" {{ request()->option == $opt->id  ? 'selected' : ''}}>
                {{$opt->value}}
              </option>
              @endforeach
            </select>
          </div>
          <div class="col-3">
            <label for="from">From</label>
            <input type="date" name="from" class="form-control select--shadow" value="{{request()->from}}">
          </div>
          <div class="col-3">
            <label for="to">To</label>
            <input type="date" name="to" class="form-control select--shadow" value="{{request()->to}}">
          </div>
          <div class="col-3">
            <button type="submit"
              class="btn bg-gradient-primary mr-1 mt-2 waves-effect waves-light btn-block">Search</button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0">NPS Score: <code class="highlighter-rouge">{{ $nps }}</code></h4>
        </div>
        <div class="card-content">
          <div class="table-responsive mt-1">
            <table class="table table-hover-animation mb-0">
              <thead>
                <tr>
                  <th>SCORE</th>
                  <th>COUNT</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($scores as $s)
                <tr>
                  <td class="w-25">{{ $s->score }}</td>
                  <td>
                    <div class="text-center" id="example-caption-2">
                      <a href="{{ url('report/nps/users/'.$s->score) }}">Counts…{{$s->count}}</a>
                    </div>
                    <div class="progress progress-bar-primary">
                      <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="50"
                        aria-valuemax="100" style="width:{{$s->count / $total * 100}}%"
                        aria-describedby="example-caption-2"></div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
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