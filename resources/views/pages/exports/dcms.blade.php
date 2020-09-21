<table>
    <thead>
        <tr>
            <th>Applicant's Name(as per NRIC)</th>
            <th>Preferred Name</th>
            <th>ID No.</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Citizenship</th>
            <th>Country</th>
            <th>Race</th>
            <th>Marital Status</th>
            <th>Position Applied</th>
            <th>License Exam Pass Date</th>
            <th>State</th>
            <th>Contact Number Office (alternate)</th>
            <th>Mobile</th>
            <th>Personal email</th>
            <th>Mail Address1</th>
            <th>Mail State</th>
            <th>Mail Country</th>
            <th>Mail Region</th>
            <th>Highest Educational Qualification</th>
            <th>University Name</th>
            <th>Spouse Name</th>
            <th>NRIC New No.</th>
            <th>Occupation</th>
            <th>Company Name</th>
            <th>Have you ever been a staff of CUSTOMER or any of its agency?</th>
            <th>Department/Agency Name</th>
            <th>Position Held</th>
            <th>From</th>
            <th>To</th>
            <th>Please provide your current and past employment details if any.</th>
            {{-- Current Postion --}}
            <th>Current-Company Name</th>
            <th>Current-Position Held</th>
            <th>From</th>
            <th>To</th>
            <th>Current-Annual Income</th>
            <th>Current-Type of Industry</th>
            {{-- Pervious --}}
            @foreach($applicants as $applicant)
            @php
            $employment = json_decode($applicant->employment);
            if (isset($employment) && is_array($employment)) {
            array_shift($employment);
            } else {
            $employment = [];
            }
            @endphp
            @foreach ($employment as $e)
            <th>Previous-Company Name</th>
            <th>Previous-Position Held</th>
            <th>From</th>
            <th>To</th>
            <th>Previous-Annual Income</th>
            <th>Previous-Type of Industry</th>
            @endforeach
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($applicants as $applicant)
        <tr>
            <td>{{ $applicant->name }}</td>
            <td>{{ $applicant->preferred_name }}</td>
            <td>{{ $applicant->nrc }}</td>
            <td>{{ $applicant->dob }}</td>
            <td>{{ $applicant->gender }}</td>
            <td>{{ $applicant->myanmar_citizen }}</td>
            <td>Country</td>
            <td>{{ $applicant->race }}</td>
            <td>{{ $applicant->married }}</td>
            <td> - </td>
            <td>{{ $applicant->submitted_date }}</td> {{-- TODO: Exam Past Date --}}
            <td>{{ DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-' }}
            </td>
            <td>{{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
            <td>{{ $applicant->phone }}</td>
            <td>{{ $applicant->phone }}</td>
            <td>{{ $applicant->email }}</td>
            <td>{{ $applicant->address }}</td>
            <td>{{ DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-' }}
            </td>
            <td>{{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
            <td>Myanmar</td>
            <td>{{ $applicant->education }}</td>
            <td> - </td>
            <td>{{ $applicant->spouse_name }}</td>
            <td>{{ $applicant->spouse_nrc }}</td>
            <td>{{ $applicant->spouse_occupation }}</td>
            <td>{{ $applicant->spouse_company_name }}</td>
            <td>@if($applicant->prudential_agency_exp == null || $applicant->prudential_agency_exp == '') : No @endif
            </td>
            <td>@if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->department_name }} @endif </td>
            <td>@if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->position }}@endif</td>
            <td>@if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->position }}@endif</td>
            <td>@if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->duration_to_date ?? "-" }}@endif</td>
            <td>@if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->duration_from_date ?? "-" }}@endif</td>
            <td>
                {{ json_decode($applicant->employment)[0]->company_name ?? "-"}}
            </td>
            <td>
                {{ json_decode($applicant->employment)[0]->position ?? "-"}}
            </td>
            <td>
                {{ json_decode($applicant->employment)[0]->duration_from_date ?? "-" }}
            </td>
            <td>
                {{ json_decode($applicant->employment)[0]->duration_to_date ?? "-"}}
            </td>
            <td>
                {{ json_decode($applicant->employment)[0]->income ?? "-" }}
            </td>
            <td>
                {{ json_decode($applicant->employment)[0]->industry_type ?? "-"}}
            </td>
            @foreach ($employment as $e)
            <th></th>
            <th>{{ $e->position }}</th>
            <th>{{ $e->duration_from_date }}</th>
            <th>{{ $e->duration_to_date }}</th>
            <th>{{ $e->income }}</th>
            <th>{{ $e->industry_type }}</th>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>