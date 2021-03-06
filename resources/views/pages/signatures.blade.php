@extends('layouts.contentLayoutMaster')

@section('title')System Configuration @endsection

@section('content')
@include('layouts._flash-message')
@if (Auth::user()->partner_id =="")
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">Signatures</h4>
                </div>
                <form action="{{ url('/signatures/update') }}" method="post" enctype="multipart/form-data"
                    class="form form-vertical" id="signatures-form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-7 mx-2">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical" class="col-form-label">
                                                <strong>
                                                    Contractor Title
                                                </strong>
                                            </label>
                                            <input type="text" class="form-control" name="contractor_title"
                                                value="{{ $contractor_signatures_setting['title'] ?? '' }}"
                                                placeholder="Your title">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical" class="col-form-label">
                                                <strong>
                                                    Contractor Name
                                                </strong>
                                            </label>
                                            <input type="text" class="form-control" name="contractor_name"
                                                value="{{ $contractor_signatures_setting['name'] ?? '' }}"
                                                placeholder="Your name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical" class="col-form-label">
                                                <strong>
                                                    Contractor Sign
                                                </strong>
                                            </label>
                                            <input type="file" class="form-control" accept="image/*"
                                                name="contractor_sign">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            @if(isset($contractor_signatures_setting['image'])&&$contractor_signatures_setting['image']!='')
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">
                                        <strong>Contractor Signature</strong>
                                    </label>
                                </div>
                                <div class="col-12 my-1">
                                    <img class="img-fluid"
                                        src="{{ asset('storage/'.$contractor_signatures_setting['image']) }}">
                                </div>
                                <div class="col-12 my-1">
                                    <a href="{{ url('/setting/remove_viber_img/'.$contractor_signatures_setting['id']) }}"
                                        class="btn btn-secondary btn-block">
                                        Remove Sign
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-7 mx-2">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical" class="col-form-label">
                                                <strong>
                                                    Witness Title
                                                </strong>
                                            </label>
                                            <input type="text" class="form-control" name="witness_title"
                                                value="{{ $witness_signatures_setting['title'] ?? '' }}"
                                                placeholder="Your title">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical" class="col-form-label">
                                                <strong>
                                                    Witness Name
                                                </strong>
                                            </label>
                                            <input type="text" class="form-control" name="witness_name"
                                                value="{{ $witness_signatures_setting['name'] ?? '' }}"
                                                placeholder="Your name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical" class="col-form-label">
                                                <strong>
                                                    Witness Sign
                                                </strong>
                                            </label>
                                            <input type="file" class="form-control" accept="image/*"
                                                name="witness_sign">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            @if(isset($witness_signatures_setting['image']) && $witness_signatures_setting['image']!='')
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">
                                        <strong>Witness Signature</strong>
                                    </label>
                                </div>
                                <div class="col-12 my-1">
                                    <img class="img-fluid"
                                        src="{{ asset('storage/'.$witness_signatures_setting['image']) }}">
                                </div>
                                <div class="col-12 my-1">
                                    <a href="{{ url('/setting/remove_viber_img/'.$witness_signatures_setting['id']) }}"
                                        class="btn btn-secondary btn-block">
                                        Remove Sign
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary pull-right" form="signatures-form">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection