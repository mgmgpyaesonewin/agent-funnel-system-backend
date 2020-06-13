@extends('layouts.master')

@section('page-title')Promo Code @endsection

@section('content')
<nav aria-label="breadcrumb">
<h2 class="content-header-title float-left mb-0">Promo Code</h2>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
    <li class="breadcrumb-item"><a href="{{ url('/project/promo') }}">Promo Code</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add New</li>
  </ol>
</nav>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="row my-lg-3 mx-lg-3">
        <form class="w-75" action="{{ url('/project/promo/store') }}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-row">
              <div class="form-group col-md-6">
                <label>Promo Name</label>
                <input type="text" class="form-control @if($errors->has('code')) is-invalid @endif" name="code" placeholder="Promo Name" value="{{ old('code') }}"  required >
                
                @if ($errors->has('code'))
                <div class="invalid-feedback">{{ $errors->first('code')  }}</div>
                @endif
              </div>
            </div>
            <div class="form-row">            
              <div class="form-group col-md-6">
                <label>Pomo Type</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="rdopercent" name="type" class="custom-control-input" value="percentage" checked>
                  <label class="custom-control-label" for="rdopercent">Percentage</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="rdoamount" name="type" class="custom-control-input" value="amount">
                  <label class="custom-control-label" for="rdoamount">Amount</label>
                </div>
              </div>
              <div class="form-group col-md-6 pl-2">
                <label>Promo Value</label>
                <input type="number" class="form-control @if($errors->has('value')) is-invalid @endif" name="value" placeholder="Promo Value" value="{{ old('value') }}" required>
                @if($errors->has('value'))
                <div class="invalid-feedback">{{ $errors->first('value') }}</div>
                @endif
              </div>
            </div>

            <div class="form-row">

              <div class="form-group col-md-6">            
                <label for="inputState">Valid From</label>
        
                <input class="form-control @if($errors->has('from')) is-invalid @endif" name="from" type="date" placeholder="From" value="{{ old('from') }}">  
                @if($errors->any('from'))                  
                <div class="invalid-feedback">{{$errors->first('from')}}</div>
                @endif                  
              </div>
              
              <div class="form-group col-md-6 pl-2">      
                <label for="inputState">Valid To</label> 
              
                <input class="form-control @if($errors->has('to')) is-invalid @endif" name="to" type="date" placeholder="To" value="{{ old('to') }}">  
                
                @if($errors->has('to'))
                <div class="invalid-feedback">{{ $errors->first('to') }}</div>
                @endif                
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">Category</label>
                <select class="form-control" name="category">
                  <option value="">--All--</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6 pl-2">
                <label for="inputState">Service Type</label>
                <select class="form-control" name="service_type">
                  <option value="">-- All --</option>
                  <option value="1" @if(old('service_type') == '1') selected @endif>Standard</option>
                  <option value="3" @if(old('service_type') == '3') selected @endif>Premium</option>
                  <option value="4" @if(old('service_type') == '4') selected @endif>Enterprise</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Remark</label>
                <textarea class="form-control" name="remark" rows="2"></textarea>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
        
      </div>
    </div>
  </div>
</div>

@endsection


