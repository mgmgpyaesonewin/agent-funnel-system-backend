@extends('layouts/contentLayoutMaster')

@section('title', 'PMLI Filter')

@section('content')
{{-- Dashboard Analytics Start --}}
<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <v-search-form current-status="pmli_filter" :statuses-array="{{ $statuses }}"
                            assign-field="true" aml-check="true"></v-search-form>
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
                        <v-table ref="table" current-status="pmli_filter" :status="[1,2,3,5,6]" :assign-checkbox="true"
                            channel="true" :user-assign="true" assign="true" status-col="true" temp-id="true" :aml-status="true" status-col="true"
                            :is-partner="{{ auth()->user()->partner_id != null ? 1 : 0 }}">>
                            <template scope="{ applicant }">
                                <td>
                                    <div class="btn-group mt-1" v-show="applicant.status_id === 1">
                                        <v-button button-class="btn btn-info"
                                            :old-current-status="applicant.current_status"
                                            new-current-status="pmli_filter" :old-status-id="applicant.status_id"
                                            new-status-id="2" :applicant-id="applicant.id">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </v-button>
                                        <v-button button-class="btn btn-success"
                                            :old-current-status="applicant.current_status"
                                            :old-status-id="applicant.status_id" new-current-status="pmli_filter"
                                            :e-learning="true" new-status-id="3" :applicant-id="applicant.id">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </v-button>
                                        <v-button button-class="btn btn-danger"
                                            :old-current-status="applicant.current_status"
                                            new-current-status="pmli_filter" :old-status-id="applicant.status_id"
                                            new-status-id="4" :applicant-id="applicant.id">
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