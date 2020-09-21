@extends('layouts.contentLayoutMaster')

@section('title')Terms And Conditions Configuration @endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-content">
                <v-document-editor document='{{ $document }}'></v-document-editor>
            </div>
        </div>
    </div>
</div>
@endsection