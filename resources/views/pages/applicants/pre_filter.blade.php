@extends('layouts/contentLayoutMaster')

@section('title', 'Pending Applicants')

@section('content')
{{-- Dashboard Analytics Start --}}
<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <v-search-form current-status="pre_filter" export-url="pmli_filter" :enable-export="true"
                            :statuses-array="{{ $statuses }}"></v-search-form>
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
                        <v-table ref="table" current-status="pre_filter" :status="[1,7]" channel="true"
                            :assign-checkbox="true" status-col="true" status-col="true" :user-assign="true"
                            assign="true" :is-partner="true">
                            <template scope="{ applicant }">
                                <div class="btn-group mt-1" v-show="applicant.status_id === 1">
                                    <v-button button-class="btn btn-success"
                                        :old-current-status="applicant.current_status" new-current-status="pru_dna_test"
                                        :old-status-id="applicant.status_id" new-status-id="1"
                                        :applicant-id="applicant.id">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </v-button>
                                    <v-button button-class="btn btn-danger"
                                        :old-current-status="applicant.current_status" new-current-status="pre_filter"
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