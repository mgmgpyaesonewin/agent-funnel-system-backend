@extends('layouts/contentLayoutMaster')

@section('title', 'Screened Applicants')

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
                        <v-table ref="table" status="[2, 3]" :webinar-invite="true">
                            <template scope="{ applicant }">
                                <td>
                                    <div class="row mx-0">
                                        <a :href="`http://localhost:8000/applicants/${applicant.id}`"
                                            class="btn btn-primary btn-block">View</a>
                                    </div>
                                    <div class="btn-group mt-1" v-show="applicant.status_id === 2">
                                        <v-button button-class="btn btn-success" :old-status-id="applicant.status_id"
                                            new-status-id="3" :applicant-id="applicant.id" table-status="[2,3]">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </v-button>
                                        <v-button button-class="btn btn-danger" :old-status-id="applicant.status_id"
                                            new-status-id="12" :applicant-id="applicant.id" reason-id="1"
                                            table-status="[2,3]">
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