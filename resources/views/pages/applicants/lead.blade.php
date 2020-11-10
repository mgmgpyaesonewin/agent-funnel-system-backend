@extends('layouts/contentLayoutMaster')

@section('title', 'Leads')

@section('content')

<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <v-search-form current-status="lead" :statuses-array="{{ $statuses }}"></v-search-form>
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
                            status-col="true" :user-assign="true" assign="true" gender="true" age="true"
                            :is-partner="{{ auth()->user()->partner_id != null ? 1 : 0 }}">
                            <template scope="{ applicant }">
                                <div class="btn-group mt-1" v-show="applicant.status_id === 1">
                                    <v-bop-sessions-button button-class="btn btn-success btn-group-first"
                                        :old-current-status="applicant.current_status" new-current-status="bop_session"
                                        :old-status-id="applicant.status_id" :new-status-id="1" :reassign="false"
                                        :applicant-id="applicant.id" :bop-sessions="{{ json_encode($bop_sessions) }}">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </v-bop-sessions-button>
                                    <v-button button-class="btn btn-secondary"
                                        :old-current-status="applicant.current_status" new-current-status="lead"
                                        :old-status-id="applicant.status_id" :new-status-id="4"
                                        :applicant-id="applicant.id" type="reject">
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
