<table>
    <thead>
        <tr>
            <th>Agent ID</th>
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
            <th>Do you have any selling experience or have acted as an agent either directly or indirectly in the life
                insurance
                industry or similar institutions?</th>
            <th>Company Name</th>
            <th>Position Held</th>
            <th>Are any of your family member (including spouse and children) an agent or a staff of CUSTOMER</th>
            <th>Name</th>
            <th>NRC</th>
            <th>Agent ID</th>
            <th>Company Name</th>
            <th>Position Held</th>
            <th>Relation to Applicant</th>
            <th>Previous Company Name</th>
            <th>Previous Company Cessation Date</th>
            <th>Nominee Name</th>
            <th>Nominee Nationality</th>
            <th>Nominee NRIC</th>
            <th>Nominee Passport No</th>
            <th>Nominee Age</th>
            <th>Nominee Address1</th>
            <th>Nominee Contact no.</th>
            <th>Nominee Relationship with Applicant</th>
            <th>Payee ID Type</th>
            <th>Payee ID No</th>
            <th>Bank Name</th>
            <th>Bank Account No</th>
            <th>Payee Name</th>
            <th>Swift Code</th>
            <th>Spouse Citizenship</th>
            <th>Nominee State</th>
            {{-- Employment --}}
            <th>Please provide your current and past employment details if any.</th>
            {{-- Current Postion --}}
            <th>Current-Company Name</th>
            <th>Current-Position Held</th>
            <th>From</th>
            <th>To</th>
            <th>Current-Annual Income</th>
            <th>Current-Type of Industry</th>
            {{-- Pervious --}}
            @for($employment = 0; $employment < $max_employments; $employment++) <th>Previous-Company Name</th>
                <th>Previous-Position Held</th>
                <th>From</th>
                <th>To</th>
                <th>Previous-Annual Income</th>
                <th>Previous-Type of Industry</th>
                @endfor
                {{-- Pervious End --}}
        </tr>
    </thead>
    <tbody>
        @foreach($applicants as $applicant)
        <tr>
            <td>{{ $applicant->agent_code }}</td>
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
                {{ DB::table('applicant_status')->where([['applicant_id', $applicant->id],['current_status', 'onboard'],['status_id', 1]])->first()->created_at ?? "-" }}
            </td>
            <td>{{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}
            </td>
            <td>{{ $applicant->secondary_phone }}</td>
            <td>{{ $applicant->phone }}</td>
            <td>{{ $applicant->email }}</td>
            <td>{{ $applicant->address }}</td>
            <td>{{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
            <td>{{ $applicant->myanmar_citizen === 1 ? 'Myanmar' : $applicant->citizen }}</td>
            <td>{{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
            <td>{{ $applicant->education }}</td>
            <td> - </td>
            <td>{{ $applicant->spouse_name }}</td>
            <td>{{ $applicant->spouse_nrc }}</td>
            <td>{{ $applicant->spouse_occupation }}</td>
            <td>{{ $applicant->spouse_company_name }}</td>
            <td>
                @if($applicant->prudential_agency_exp == null || $applicant->prudential_agency_exp == '')
                No
                @else
                Yes
                @endif
            </td>
            <td>
                @if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->department_name }}
                @endif
            </td>
            <td>
                @if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->position }}
                @endif
            </td>
            <td>
                @if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->duration_to_date ?? "-" }}
                @endif
            </td>
            <td>
                @if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
                {{ json_decode($applicant->prudential_agency_exp)->duration_from_date ?? "-" }}
                @endif
            </td>
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
            @if($applicant->family_agent != null || $applicant->family_agent != '')
            <td>Yes</td>
            @else
            <td>No</td>
            @endif
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
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>NRIC - New Number</td>
            <td>{{ $applicant->nrc }}</td>
            <td>{{ $applicant->bank_account_name }}</td>
            <td>{{ $applicant->bank_account_no }}</td>
            <td>{{ $applicant->name }}</td>
            <td>{{ $applicant->swift_code }}</td>
            <td></td>
            <td></td>
            <td>
                {{  $applicant->employments ? "Yes" : "No" }}
            </td>
            {{-- START employment exp --}}
            <td>
                @if($applicant->employments && $applicant->employments[0]->duration_to_date == '')
                {{  $applicant->employments[0]->company_name ?? "-" }}
                @endif
            </td>
            <td>
            @if($applicant->employments && $applicant->employments[0]->duration_to_date == '')
                {{ $applicant->employments[0]->position ?? "-"}}
            @endif
            </td>
            <td>
            @if($applicant->employments && $applicant->employments[0]->duration_to_date == '')
                {{ $applicant->employments[0]->duration_from_date ?? "-" }}
            @endif
            </td>
            <td>
            @if($applicant->employments && $applicant->employments[0]->duration_to_date == '')
                {{ $applicant->employments[0]->duration_to_date ?? "-"}}
            @endif
            </td>
            <td>
            @if($applicant->employments && $applicant->employments[0]->duration_to_date == '')
                {{ $applicant->employments[0]->income ?? "-" }}
            @endif
            </td>
            <td>
            @if($applicant->employments && $applicant->employments[0]->duration_to_date == '')
                {{ $applicant->employments[0]->industry_type ?? "-"}}
            @endif
            </td>
            @php
                if($applicant->employments && $applicant->employments[0]->duration_to_date == '')
                    $start = 1;
                else
                    $start = 0;
            @endphp
            @foreach ($applicant->employments as $k => $v) 
            @php
                if ($k < $start) continue;
            @endphp
            <td>{{ $v->company_name }}</td>
            <td>{{ $v->position }}</td>
            <td>{{ $v->duration_from_date }}</td>
            <td>{{ $v->duration_to_date }}</td>
            <td>{{ $v->income }}</td>
            <td>{{ $v->industry_type }}</td>
            @endforeach
            {{-- END employment exp --}}
        </tr>
        @endforeach
    </tbody>
</table>
