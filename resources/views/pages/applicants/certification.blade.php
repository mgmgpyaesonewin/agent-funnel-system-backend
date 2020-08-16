@extends('layouts/contentLayoutMaster')

@section('title', 'Certification Fitler')

@section('content')
{{-- Dashboard Analytics Start --}}
<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <v-search-form :exam-date="true" :statuses-array="{{ $statuses }}"></v-search-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body text-center">
                        <v-certification-table ref="table" current-status="certification" temp-id="true">
                        </v-certification-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection