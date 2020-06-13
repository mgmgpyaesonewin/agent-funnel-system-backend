@extends('layouts.master')

@section('page-title')Promo Code @endsection

@section('content')
<nav aria-label="breadcrumb">
<h2 class="content-header-title float-left mb-0"> Promo Code</h2>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item active" aria-current="page">Promo Code</li>
  </ol>
</nav>

<!-- Success Message from promo create page -->
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <p class="mb-0">{{ session('status') }}</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
@endif

<!-- Error message if either one of the fromDate or toDate is not chosen -->
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <p class="mb-0">{{$errors->first()}}</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
@endif

<div class="row">
  <form action="{{ url('/project/promo') }}" method="get">
  <div class="col-12">
      <div class="row my-1">
        <div class="col">
          <input class="form-control" name="code" type="text" placeholder="Promo Name" value="{{app('request')->input('code')}}">
        </div>        
        <div class="col">
          <select name="type" class="form-control">
              <option value="">Promo Type</option>
              <option value="percentage" @if(app('request')->input('type') == 'percentage') selected @endif>Percentage</option>
              <option value="amount" @if(app('request')->input('type') == 'amount') selected @endif>Amount</option>
            </select>
        </div>
        <div class="col">
            <select name="category" class="form-control" name="category">
              <option value=""> Category </option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}" @if(app('request')->input('category')) selected @endif >{{ $category->name }}</option>
              @endforeach
            </select>
        </div>
        <div class="col">
            <select name="service" class="form-control">
              <option value="">Service Type</option>
              <option value="1" @if(app('request')->input('service') == "1") selected @endif>Standard</option>
              <option value="3" @if(app('request')->input('service') == "3") selected @endif>Premium</option>
              <option value="4" @if(app('request')->input('service') == "4") selected @endif>Enterprise</option>
            </select>
        </div>
        

        <div class="w-100"><br></div>
        <div class="col">
          <select name="status" class="form-control">
            <option value="">Status</option>
            <option value="active" @if(app('request')->input('status') == "active") selected @endif>Active</option>
            <option value="pause" @if(app('request')->input('status') == "pause") selected @endif>Paused</option>
            <option value="finished" @if(app('request')->input('status') == "finished") selected @endif>Finished</option>
          </select>
        </div>
        <div class="col">
          <input class="form-control" name="from" type="date" placeholder="From" value="{{ app('request')->input('from') }}">
        </div>

        <div class="col">
          <input class="form-control" name="to" type="date" placeholder="To" value="{{ app('request')->input('to') }}">
        </div>

        <div class="col">
          <button type="submit" class="btn btn-primary"> Search </button>
        </div>

      </div>        
    </div>
</div>

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0">Total <span class="badge badge-success badge-pill">{{$codes->total()}}</span> records found.</h4>
          <a href="{{ url('/project/promo/create')}}" class="btn btn-flat-success waves-effect waves-light"><i class="feather icon-plus"></i>Add New</a>
        </div>
        <div class="card-content">
          <div class="table-responsive mt-1">
            <table class="table table-hover-animation mb-0 text-center">
              <thead>
                <tr>                  
                  <th>Status</th>
                  <th>Promo Name</th>
                  <th>Total Used</th>
                  <th>Amount</th>
                  <th>Category</th>
                  <th>Service Type</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @if (count($codes)) 
                @foreach ($codes as $code)
                <tr>
                  <td class="text-capitalize"><i class="fa fa-circle font-small-3 @if ($code->status == 'active') text-success @else text-warning @endif mr-50"></i>{{$code->status}}</td>
                  <td>
                    @if ($code->remark != null)
                    <a class="text-underline text-primary" data-toggle="popover" data-placement="top" data-container="body" data-content="{{$code->remark}}">{{$code->code}}</a>
                    @else
                    {{$code->code}}
                    @endif
                  </td>                  
                  <td>{{$code->project->count()}}</td>
                  <td>
                    {{$code->value}}
                    {{ $code->type == "percentage" ? "%" : "MMK" }}
                  </td>
                  <td>{{$code->name != '' ? $code->name : "All"}}</td>
                  <td>
                    @if($code->service_type_id == '1')
                      Standard
                    @elseif ($code->service_type_id == '3')
                      Premium
                    @elseif($code->service_type_id == '4')
                      Enterprise
                    @else
                      All
                    @endif
                  </td>
                  <td>{{date('d-m-Y', strtotime($code->from))}}</td>
                  <td>{{date('d-m-Y', strtotime($code->to))}}</td>
                  <td class="text-left">
                    <!-- <a href="" class="btn btn-icon btn-info"><i class="feather icon-edit"></i></a>
                    <a href="" class="btn btn-icon btn-warning"><i class="feather icon-pause"></i></a>
                    @if($code->project->count() == 0)
                      <a href="" class="btn btn-icon btn-danger"><i class="feather icon-trash-2"></i></a>
                    @endif -->
                  </td>
                </tr>
                @endforeach
              @else
                <tr><td colspan="8">No record found.</td></tr>
              @endif       
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
      <div class="row  justify-content-md-center">{{ $codes->appends(Request::input())->links() }}</div>
    </div>
  </div>
@endsection

@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/popover/popover.js')) }}"></script>

@endsection

