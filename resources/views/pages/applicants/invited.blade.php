@extends('layouts/contentLayoutMaster')

@section('title', 'Invited Applicants')

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
                        <v-table ref="table" status="[4,5,7]">
                            <template scope="{ applicant }">
                                <td>
                                    <a :href="`http://mpt-portal.test/applicants/${applicant.id}`"
                                        class="btn btn-primary btn-block">View</a>
                                    <v-button button-class="btn btn-danger btn-block"
                                        :old-status-id="applicant.status_id" new-status-id="12" reason-id="4"
                                        :applicant-id="applicant.id" table-status="[4,5,7]">
                                        Reject
                                    </v-button>
                                    <v-button button-class="btn btn-warning btn-block"
                                        :old-status-id="applicant.status_id" new-status-id="7"
                                        :applicant-id="applicant.id" table-status="[4,5,7]">
                                        No Show
                                    </v-button>
                                    <v-button v-show="applicant.status_id == 5" button-class="btn btn-success btn-block"
                                        :old-status-id="applicant.status_id" new-status-id="8"
                                        :applicant-id="applicant.id" table-status="[4,5,7]">
                                        On Board
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