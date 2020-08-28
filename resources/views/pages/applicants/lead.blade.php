@extends('layouts/contentLayoutMaster')

@section('title', 'Pending Applicants')

@section('content')

<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <v-search-form current-status="lead" export-url="pmli_filter" :enable-export="true"
                            :statuses-array="{{ $statuses }}"></v-search-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 my-1">
            @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p class="mb-0">{{ session('status') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 my-1">
            <a href="{{url('create_lead')}}" class="btn btn-primary pull-right">Create</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body text-center">
                        <v-table ref="table" current-status="lead" :status="[1,7]" :assign-checkbox="true"
                            status-col="true" :user-assign="true" assign="true"
                            :is-partner="{{ auth()->user()->partner_id != null ? 1 : 0 }}">
                            <template scope="{ applicant }">
                                <div class="btn-group mt-1" v-show="applicant.status_id === 1">
                                    <v-button button-class="btn btn-success"
                                        :old-current-status="applicant.current_status" new-current-status="pre_filter"
                                        :old-status-id="applicant.status_id" new-status-id="1"
                                        :applicant-id="applicant.id">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </v-button>
                                    <v-button button-class="btn btn-secondary"
                                        :old-current-status="applicant.current_status" new-current-status="lead"
                                        :old-status-id="applicant.status_id" new-status-id="4"
                                        :applicant-id="applicant.id">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </v-button>
                                </div>
                            </template>
                        </v-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection