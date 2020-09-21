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
            <th>Do you have any selling experience or have acted as an agent either directly or indirectly in the life
                insurance
                industry or similar institutions?</th>
            <th>Company Name</th>
            <th>Position Held</th>
            <th>Are any of your family member (including spouse and children) an agent or a staff of CUSTOMER</th>
            <th>Name</th>
            <th>NRC</th>
            <th>Agent</th>
            <th>Company Name</th>
            <th>Position Held</th>
            <th>Relation to Applicant</th>
            <th>Payee ID No</th>
            <th>Bank Account Name</th>
            <th>Bank Account No</th>
            <th>Payee Name</th>
            <th>Swift Code</th>
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
            <td>{{ $applicant->myanmar_citizen === 1 ? 'Myanmar' : $applicant->citizen }}</td>
            <td>{{ $applicant->myanmar_citizen === 1 ? 'Myanmar' : 'Other' }}</td>
            <td>{{ $applicant->race }}</td>
            <td>{{ $applicant->married }}</td>
            <td> - </td>
            <td>
                {{ DB::table('applicant_status')->where([['applicant_id', $applicant->id],['current_status', 'pru_dna_test'],['status_id', 5]])->first()->created_at ?? "-" }}
            </td>
            <td>{{ DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-' }}
            </td>
            <td>{{ $applicant->secondary_phone }}</td>
            <td>{{ $applicant->phone }}</td>
            <td>{{ $applicant->email }}</td>
            <td>{{ $applicant->address }}</td>
            <td>{{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
            <td>Myanmar</td>
            <td>{{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
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
            <td></td>
            <td>{{ $e->position }}</td>
            <td>{{ $e->duration_from_date }}</td>
            <td>{{ $e->duration_to_date }}</td>
            <td>{{ $e->income }}</td>
            <td>{{ $e->industry_type }}</td>
            @endforeach
            @if($applicant->agent_exp != null || $applicant->agent_exp != '')
            <td>Yes</td>
            @else
            <td>No</td>
            @endif
            <td>
                @if($applicant->agent_exp != null || $applicant->agent_exp != '')
                {{ json_decode($applicant->agent_exp)->company_name ?? "-"  }}
                @endif
            </td>
            <td>
                @if($applicant->agent_exp != null || $applicant->agent_exp != '')
                {{ json_decode($applicant->agent_exp)->position ?? "-"  }}
                @endif
            </td>
            <td>
                @if($applicant->family_agent != null || $applicant->family_agent != '')
                {{ json_decode($applicant->family_agent)->name ?? "-"  }}
                @endif
            </td>
            <td>
                @if($applicant->family_agent != null || $applicant->family_agent != '')
                {{ json_decode($applicant->family_agent)->nrc ?? "-"  }}
                @endif
            </td>
            <td>
                @if($applicant->family_agent != null || $applicant->family_agent != '')
                {{ json_decode($applicant->family_agent)->agent_code ?? "-"  }}
                @endif
            </td>
            <td>
                @if($applicant->family_agent != null || $applicant->family_agent != '')
                {{ json_decode($applicant->family_agent)->company_name ?? "-"  }}
                @endif
            </td>
            <td>
                @if($applicant->family_agent != null || $applicant->family_agent != '')
                {{ json_decode($applicant->family_agent)->position ?? "-"  }}
                @endif
            </td>
            <td>
                @if($applicant->family_agent != null || $applicant->family_agent != '')
                {{ json_decode($applicant->family_agent)->relation ?? "-"  }}
                @endif
            </td>
            <td>{{ $applicant->nrc }}</td>
            <td>{{ $applicant->bank_account_name }}</td>
            <td>{{ $applicant->bank_account_no }}</td>
            <td>{{ $applicant->name }}</td>
            <td>{{ $applicant->swift_code }}</td>
        </tr>
        @endforeach
    </tbody>
</table>