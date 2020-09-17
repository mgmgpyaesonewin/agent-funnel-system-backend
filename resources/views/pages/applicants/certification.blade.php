@extends('layouts/contentLayoutMaster')

@section('title', 'Certification')

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
                        <v-table ref="table" current-status="certification" :temp-id="true" :exam="true" channel="true"
                            assign="true" :user-assign="true" status-col="true"
                            :is-partner="{{ auth()->user()->partner_id != null ? 1 : 0 }}">
                            <template scope="{ applicant }">
                                <td>
                                    <div class="btn-group mt-1" v-show="applicant.status_id === 1">
                                        <v-button button-class="btn btn-success"
                                            :old-current-status="applicant.current_status" new-current-status="onboard"
                                            :old-status-id="applicant.status_id" :new-status-id="1"
                                            :applicant-id="applicant.id">
                                            <i class="fa fa-check" aria-hidden="true"></i> Passed
                                        </v-button>
                                        <v-button button-class="btn btn-danger"
                                            :old-current-status="applicant.current_status"
                                            new-current-status="certification" :old-status-id="applicant.status_id"
                                            :new-status-id="4" :applicant-id="applicant.id">
                                            <i class="fa fa-times" aria-hidden="true"></i> Failed
                                        </v-button>
                                    </div>
                                </td>
                            </template>
                        </v-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection