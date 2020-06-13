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
@endsection

@section('content')
{{-- Dashboard Analytics Start --}}
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Dispatched Orders</h4>
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
                                <tr>
                                    <td>#879985</td>
                                    <td>
                                        <div class="text-center" id="example-caption-2">Reticulating splines… 25%</div>
                                        <div class="progress progress-bar-primary">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="25"
                                                aria-valuemin="50" aria-valuemax="100" style="width:35%"
                                                aria-describedby="example-caption-2"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#879985</td>
                                    <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>Moving</td>
                                </tr>
                                <tr>
                                    <td>#879985</td>
                                    <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>Moving</td>
                                </tr>
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