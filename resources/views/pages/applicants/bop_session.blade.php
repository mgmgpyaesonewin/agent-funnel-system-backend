@extends('layouts/contentLayoutMaster')

@section('title', 'BOP Session')

@section('content')

<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <v-search-form current-status="bop_session" :statuses-array="{{ $statuses }}"></v-search-form>
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
                        <v-table ref="table" current-status="bop_session" :status="[1,4]" :assign-checkbox="true"
                            status-col="true" :user-assign="true" assign="true"
                            :is-partner="{{ auth()->user()->partner_id != null ? 1 : 0 }}">
                            <template scope="{ applicant }">
                                <div class="btn-group mt-1" v-show="applicant.status_id === 1">
                                    <v-button button-class="btn btn-success"
                                        :old-current-status="applicant.current_status" new-current-status="pre_filter"
                                        :old-status-id="applicant.status_id" :new-status-id="1"
                                        :applicant-id="applicant.id" type="accept">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </v-button>
                                    <v-button button-class="btn btn-danger"
                                        :old-current-status="applicant.current_status" new-current-status="bop_session"
                                        :old-status-id="applicant.status_id" :new-status-id="4"
                                        :applicant-id="applicant.id" type="reject">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </v-button>
                                    <v-bop-sessions-button button-class="btn btn-warning"
                                        :old-current-status="applicant.current_status" new-current-status="bop_session"
                                        :old-status-id="applicant.status_id" :new-status-id="1"
                                        :applicant-id="applicant.id" :bop-sessions="{{ json_encode($bop_sessions) }}">
                                        <i class="fa fa-calendar-times-o" aria-hidden="true"></i>
                                    </v-bop-sessions-button>
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
