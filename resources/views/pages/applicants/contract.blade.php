@extends('layouts/contentLayoutMaster')

@section('title', 'Agents')

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
                        <v-table ref="table" current-status="active" status-col="true" temp-id="true" status-col="true"
                            channel="true" :user-assign="true" assign="true"
                            :is-partner="{{ auth()->user()->partner_id != null ? 1 : 0 }}">
                            <template scope="{ applicant }">
                                <td>
                                    <div class="btn-group mt-1" v-show="applicant.status_id === 8">
                                        <v-button button-class="btn btn-secondary"
                                            :old-current-status="applicant.current_status" new-current-status="active"
                                            :old-status-id="applicant.status_id" :new-status-id="9"
                                            :applicant-id="applicant.id">
                                            <i class="fa fa-times" aria-hidden="true"></i> Suspended
                                        </v-button>
                                        <v-button button-class="btn btn-danger"
                                            :old-current-status="applicant.current_status" new-current-status="active"
                                            :old-status-id="applicant.status_id" :new-status-id="10"
                                            :applicant-id="applicant.id">
                                            <i class="fa fa-ban" aria-hidden="true"></i> Ceased Association
                                        </v-button>
                                    </div>
                                    <div class="btn-group mt-1" v-show="applicant.status_id === 9">
                                        <v-button button-class="btn btn-success"
                                            :old-current-status="applicant.current_status" new-current-status="active"
                                            :old-status-id="applicant.status_id" :new-status-id="8"
                                            :applicant-id="applicant.id">
                                            <i class="fa fa-check" aria-hidden="true"></i> Active
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