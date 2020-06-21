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
                        <v-table ref="table" status="[1]" webinar-invite=false>
                            <template scope="{ applicant }">
                                <td>
                                    <div class="row mx-0">
                                        <a :href="`http://localhost:8000/applicants/${applicant.id}`"
                                            class="btn btn-primary btn-block">View</a>
                                    </div>
                                    <div class="btn-group mt-1">
                                        <v-button button-class="btn btn-success" :old-status-id="applicant.status_id"
                                            new-status-id="2" :applicant-id="applicant.id">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </v-button>
                                        <v-button button-class="btn btn-danger" :old-status-id="applicant.status_id"
                                            new-status-id="12" :applicant-id="applicant.id" reason-id="1">
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