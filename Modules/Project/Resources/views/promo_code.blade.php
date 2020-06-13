@extends('layouts.master')

@section('content')
<nav aria-label="breadcrumb">
<h2 class="content-header-title float-left mb-0">Promo Code</h2>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Promo Code</li>
  </ol>
</nav>


<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0">Total <span class="badge badge-success badge-pill">10</span> records found.</h4>
        </div>
        <div class="card-content">
          <div class="table-responsive mt-1">
            <table class="table table-hover-animation mb-0">
              <thead>
                <tr>                  
                  <th>Status</th>
                  <th>Promo Name</th>
                  <th>Total Used</th>
                  <th>Type</th>
                  <th>Value</th>
                  <th>From</th>
                  <th>To</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>Moving</td>
                  <td><button class="btn btn-primary" data-toggle="popover" data-trigger="click" data-content="testing" data-placement="top" data-container="body">CSNEW</button></td>                  
                  <td>10</td>
                  <td>Percentage</td>
                  <td>5%</td>
                  <td>26/07/2018</td>
                  <td>28/07/2018</td>
                  <td>
                    <a href="" class="btn btn-icon btn-info"><i class="feather icon-edit"></i></a>
                    <a href="" class="btn btn-icon btn-warning"><i class="feather icon-pause"></i></a>
                    <a href="" class="btn btn-icon btn-danger"><i class="feather icon-trash-2"></i></a>
                  </td>
                </tr>
                <tr>
                  <td><i class="fa fa-circle font-small-3 text-warning mr-50"></i>Pending</td>
                  <td><button class="btn btn-primary" data-toggle="popover" data-trigger="click" data-content="testing" data-placement="top" data-container="body">CSNEW</button></td>                  
                  <td>10</td>
                  <td>Percentage</td>
                  <td>5%</td>
                  <td>26/07/2018</td>
                  <td>28/07/2018</td>
                  <td>
                    <a href="" class="btn btn-icon btn-info"><i class="feather icon-edit"></i></a>
                    <a href="" class="btn btn-icon btn-warning"><i class="feather icon-pause"></i></a>
                    <a href="" class="btn btn-icon btn-danger"><i class="feather icon-trash-2"></i></a>
                  </td>
                </tr>
                <tr>
                  <td><i class="fa fa-circle font-small-3 text-success mr-50"></i>Moving</td>
                  <td><button class="btn btn-primary" data-toggle="popover" data-trigger="click" data-content="testing" data-placement="top" data-container="body">CSNEW</button></td>                  
                  <td>10</td>
                  <td>Percentage</td>
                  <td>5%</td>
                  <td>26/07/2018</td>
                  <td>28/07/2018</td>
                  <td>
                  <a href="" class="btn btn-icon btn-info"><i class="feather icon-edit"></i></a>
                    <a href="" class="btn btn-icon btn-warning"><i class="feather icon-pause"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/components.js')) }}"></script>
@endsection

