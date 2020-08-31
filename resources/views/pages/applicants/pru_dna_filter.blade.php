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
                        <v-table ref="table" current-status="pru_dna_test" :status="[1,2,3,5,6]" channel="true"
                            :assign-checkbox="true" :user-assign="true" assign="true" status-col="true"
                            :is-partner="{{ auth()->user()->partner_id != null ? 1 : 0 }}">
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
                                    <v-button button-class="btn btn-danger" v-show="applicant.status_id === 1"
                                        :old-current-status="applicant.current_status" new-current-status="pru_dna_test"
                                        :old-status-id="applicant.status_id" new-status-id="4"
                                        :applicant-id="applicant.id">
                                        Fail
                                    </v-button>
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