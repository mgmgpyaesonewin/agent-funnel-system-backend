<table>
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $applicant->name }}</td>
        </tr>
        <tr>
            <td>Prefered Name</td>
            <td>{{ $applicant->preferred_name }}</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>{{ $applicant->phone }}</td>
        </tr>
        <tr>
            <td>Secondary Phone</td>
            <td>{{ $applicant->secondary_phone }}</td>
        </tr>
        <tr>
            <td>Prefered Name</td>
            <td>{{ $applicant->email }}</td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>{{ $applicant->gender }}</td>
        </tr>
        <tr>
            <td>Marital Status</td>
            <td>{{ $applicant->married }}</td>
        </tr>
        <tr>
            <td>NRC</td>
            <td>{{ $applicant->nrc }}</td>
        </tr>
        <tr>
            <td>DOB</td>
            <td>{{ $applicant->dob }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $applicant->address }}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
        </tr>
        <tr>
            <td>Township</td>
            <td>
                {{ DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-'}}
            </td>
        </tr>
        <tr>
            <td>Myanmar Citizen</td>
            <td>{{ ($applicant->myanmar_citizen == '1' ? 'Myanmar' : 'Other') }}</td>
        </tr>
        <tr>
            <td>Race</td>
            <td>{{ $applicant->race }}</td>
        </tr>
        <tr>
            <td>Highest Qualification</td>
            <td>{{ $applicant->education }}</td>
        </tr>
        <tr>
            <td>Conflict of Interest</td>
        </tr>
        <tr>
            <td>Spouse Name</td>
            <td>{{ $applicant->spouse_name }}</td>
        </tr>
        <tr>
            <td>Spouse NRC</td>
            <td>{{ $applicant->spouse_nrc }}</td>
        </tr>
        <tr>
            <td>Occupation</td>
            <td>{{ $applicant->spouse_occupation }}</td>
        </tr>
        <tr>
            <td>Work at</td>
            <td>{{ $applicant->spouse_company_name }}</td>
        </tr>
        <tr>
            <td>Was a staff of Prudential?</td>
        </tr>
        @php $employment = json_decode( $applicant->prudential_agency_exp, true ); @endphp
        <tr>
            <td>Position</td>
            <td>{{ $employment['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Department</td>
            <td>{{ $employment['department_name'] ?? '-'}}</td>
        </tr>
        <tr>
            <td>Start Date</td>
            <td>{{ $employment['duration_from_date'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>End Date</td>
            <td>{{ $employment['duration_to_date'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Current and past employment details</td>
        </tr>
        @php $emp = json_decode( $applicant->employment, true ); @endphp
        @foreach ($emp as $employment)
        <tr>
            <td>Position</td>
            <td>{{ $employment['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Department</td>
            <td>{{ $employment['department_name'] ?? '-'}}</td>
        </tr>
        <tr>
            <td>Start Date</td>
            <td>{{ $employment['duration_from_date'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>End Date</td>
            <td>{{ $employment['duration_to_date'] ?? '-' }}</td>
        </tr>
        @endforeach
        <tr>
            <td>Have any selling experience or acted as an agent?</td>
        </tr>
        @php $agent_exp = json_decode( $applicant->agent_exp, true ); @endphp
        <tr>
            <td>Position</td>
            <td>{{ $agent_exp['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $agent_exp['address'] ?? '-'}}</td>
        </tr>
        <tr>
            <td>Company Name</td>
            <td>{{ $agent_exp['company_name'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Family member as an agent or a staff of Prudential?</td>
        </tr>
        @php $family_agent = json_decode( $applicant->family_agent, true ); @endphp
        <tr>
            <td>Name</td>
            <td>{{ $family_agent['name'] }}</td>
        </tr>
        <tr>
            <td>Position</td>
            <td>{{ $family_agent['position'] }}</td>
        </tr>
        <tr>
            <td>Agent Code</td>
            <td>{{ $family_agent['agent_code'] }}</td>
        </tr>
        <tr>
            <td>Relation</td>
            <td>{{ $family_agent['relation'] }}</td>
        </tr>
        <tr>
            <td>NRC</td>
            <td>{{ $family_agent['nrc'] }}</td>
        </tr>
        <tr>
            <td>Trainings</td>
        </tr>
        @foreach($trainings as $module)
        <tr>
            <td>{{ $module->name }}</td>
            @if ($applicant->trainings->contains('id', $module->id))
            <td>Completed</td>
            @else
            <td>Incompleted</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>