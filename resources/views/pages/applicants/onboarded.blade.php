@extends('layouts/contentLayoutMaster')

@section('title', 'Onboarded Applicants')

@section('content')
{{-- Dashboard Analytics Start --}}
<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <v-search-form :statuses-array="{{ $statuses }}"></v-search-form>
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
                        <v-table ref="table" current-status="onboard" :status="[1,2,3,5,6,7]" :status-col="true">
                            <template scope="{ applicant }">
                                <td>
                                    <div class="btn-group mt-1">
                                        <v-button button-class="btn btn-info"
                                            :old-current-status="applicant.current_status" new-current-status="onboard"
                                            :old-status-id="applicant.status_id" new-status-id="7"
                                            :applicant-id="applicant.id">
                                            <i class="fa fa-refresh" aria-hidden="true"></i>
                                        </v-button>
                                        <v-button button-class="btn btn-success"
                                            :old-current-status="applicant.current_status" new-current-status="active"
                                            :old-status-id="applicant.status_id" new-status-id="8"
                                            :applicant-id="applicant.id">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </v-button>
                                        <v-button button-class="btn btn-danger"
                                            :old-current-status="applicant.current_status" new-current-status="onboard"
                                            :old-status-id="applicant.status_id" new-status-id="4"
                                            :applicant-id="applicant.id">
                                            <i class="fa fa-times" aria-hidden="true"></i>
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