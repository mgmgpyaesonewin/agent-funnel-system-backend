@extends('layouts/contentLayoutMaster')

@section('title', 'Pru DNA Filter')

@section('content')
{{-- Dashboard Analytics Start --}}
<section>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <v-search-form current-status="pru_dna_test" :statuses-array="{{ $statuses }}"
                            assign-field="true"></v-search-form>
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
                        <v-table ref="table" current-status="pru_dna_test" :status="[1,2,3,5,6]" :user-assign="true"
                            channel="true" assign="true" status-col="true">
                            <template scope="{ applicant }">
                                <td>
                                    <div v-show="applicant.status_id === 5">
                                        <v-interview :applicant-id="applicant.id"></v-interview>
                                    </div>
                                    <v-button button-class="btn btn-success" v-show="applicant.status_id === 1"
                                        :old-current-status="applicant.current_status"
                                        :old-status-id="applicant.status_id" new-current-status="pru_dna_test"
                                        new-status-id="5" :applicant-id="applicant.id">
                                        Pass
                                    </v-button>
                                    <div class="btn-group mt-1" v-show="applicant.status_id === 6">
                                        <v-button button-class="btn btn-success"
                                            :old-current-status="applicant.current_status"
                                            :old-status-id="applicant.status_id" new-current-status="pmli_filter"
                                            new-status-id="1" :applicant-id="applicant.id">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </v-button>
                                        <v-button button-class="btn btn-danger"
                                            :old-current-status="applicant.current_status"
                                            new-current-status="pru_dna_test" :old-status-id="applicant.status_id"
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