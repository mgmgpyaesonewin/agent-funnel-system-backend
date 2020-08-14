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
                    
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Email</th>
                          <th>Name</th>
                          <th>Preferred Name</th>
                          <th>NRC</th>
                          <th>NRC Photo</th>
                          <th>Address</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>

                      @foreach ($templates as $template)
                            <tr>
                              <td>Template Form ID {{$template->id}}</td> 
                            </tr>
                            <tr class="mb-4">
                            <td class="{{classStatus($template->email)}}">{{ showStatus($template->email) }}</td>
                              <td class="{{classStatus($template->name)}}" >{{ showStatus($template->name)}}</td>
                              <td class="{{classStatus($template->preferred_name)}}" >{{ showStatus($template->preferred_name) }}</td>
                              <td class="{{classStatus($template->nrc)}}" >{{ showStatus($template->nrc) }}</td>
                              <td class="{{classStatus($template->nrc_photo)}}" >
                                {{ showStatus($template->nrc_photo) }}
                              </td>
                              <td class="{{classStatus($template->address)}}" >
                                {{ showStatus($template->address) }}
                              </td>
                              <td>
                                <a href="{{url('template/edit/'.$template->id)}}">Edit</a>
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

@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/pages/user-profile.js')) }}"></script>
@endsection