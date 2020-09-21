<table>
    <tbody>
        <tr>
            <td> &nbsp;  Name</td>
            <td> &nbsp;  {{ $applicant->name }}</td>
        </tr>
        <tr>
            <td>  &nbsp; Prefered Name</td>
            <td> &nbsp;  {{ $applicant->preferred_name }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Phone</td>
            <td>  &nbsp; {{ $applicant->phone }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Secondary Phone</td>
            <td>  &nbsp; {{ $applicant->secondary_phone }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Prefered Name</td>
            <td> &nbsp;  {{ $applicant->email }}</td>
        </tr>
        <tr>
            <td>  &nbsp; Gender</td>
            <td>  &nbsp; {{ $applicant->gender }}</td>
        </tr>
        <tr>
            <td>  &nbsp; Marital Status</td>
            <td>  &nbsp; {{ $applicant->married }}</td>
        </tr>
        <tr>
            <td> &nbsp;  NRC</td>
            <td> &nbsp;  {{ $applicant->nrc }}</td>
        </tr>
        <tr>
            <td> &nbsp;  DOB</td>
            <td> &nbsp;  {{ $applicant->dob }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Address</td>
            <td> &nbsp;  {{ $applicant->address }}</td>
        </tr>
        <tr>
            <td> &nbsp;  City</td>
            <td> &nbsp;  {{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Township</td>
            <td> &nbsp; 
                 {{ DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-'}}
            </td>
        </tr>
        <tr>
            <td> &nbsp;  Citizenship</td>
            <td> &nbsp;  {{ ($applicant->myanmar_citizen == '1' ? 'Myanmar' : 'Other') }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Race</td>
            <td> &nbsp;  {{ $applicant->race }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Highest Qualification</td>
            <td> &nbsp;  {{ $applicant->education }}</td>
        </tr>
        @php $infos = json_decode( $applicant->additional_info, true ); @endphp
        @if($infos)
        @foreach ($infos as $info)
        @if(isset($info['value']))
        <tr>
            <td> &nbsp;  <b>{{ $info['key'] }}</b></td>
            <td> &nbsp;  {{ $info['value'] }}</td>
        </tr>
        @endif
        @endforeach
        @endif
        <tr>
            <td colspan="2"><b> &nbsp;  Declaration</b></td>
        </tr>        
        <tr>
            <td> &nbsp;  Agree to Terms and Condition </td>
            <td> &nbsp; {{{ $applicant->accept_t_n_c == '1' ? 'Yes' : '-' }} </td>
        </tr>
        <tr>
            <td> &nbsp;  Agree that the information provided is true and correct </td>
            <td> &nbsp;  {{  $applicant->correct_info == '1' ? 'Yes' : '-' }} </td>
        </tr>
        <tr>
            <td> &nbsp;  Spouse Name</td>
            <td> &nbsp;  {{ $applicant->spouse_name }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Spouse NRC</td>
            <td> &nbsp;  {{ $applicant->spouse_nrc }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Occupation</td>
            <td> &nbsp;  {{ $applicant->spouse_occupation }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Work at</td>
            <td> &nbsp;  {{ $applicant->spouse_company_name }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Was a staff of Prudential?</td>
            <td>  &nbsp; 
                 @if($applicant->prudential_agency_exp == null || $applicant->prudential_agency_exp == '') No @endif
            </td>
        </tr>
        @if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
        @php $employment = json_decode( $applicant->prudential_agency_exp, true ); @endphp
        <tr>
            <td> &nbsp;  Position</td>
            <td> &nbsp;  {{ $employment['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Department</td>
            <td> &nbsp;  {{ $employment['department_name'] ?? '-'}}</td>
        </tr>
        <tr>
            <td> &nbsp;  Start Date</td>
            <td> &nbsp;  {{ $employment['duration_from_date'] ?? '-' }}</td>
        </tr>
        <tr>
            <td> &nbsp;  End Date</td>
            <td> &nbsp;  {{ $employment['duration_to_date'] ?? '-' }}</td>
        </tr>
        @endif
        <tr>
            <td> &nbsp;  Current and past employment details</td>
            <td> &nbsp; 
                 @if($applicant->employment == null || $applicant->employment == '') No Experience  @endif
            </td>
        </tr>
        @php $emp = json_decode( $applicant->employment, true ); @endphp
        @if($applicant->employment != null|| $applicant->employment != '')
        @foreach ($emp as $employment)
        <tr>
            <td> &nbsp;  Position</td>
            <td> &nbsp;  {{ $employment['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Department</td>
            <td> &nbsp;  {{ $employment['department_name'] ?? '-'}}</td>
        </tr>
        <tr>
            <td> &nbsp;  Start Date</td>
            <td> &nbsp;  {{ $employment['duration_from_date'] ?? '-' }}</td>
        </tr>
        <tr>
            <td> &nbsp;  End Date</td>
            <td> &nbsp;  {{ $employment['duration_to_date'] ?? '-' }}</td>
        </tr>
        @endforeach
        @endif
        <tr>
            <td> &nbsp;  Have any selling experience or acted as an agent?</td>
            <td> &nbsp;  @if($applicant->agent_exp == null || $applicant->agent_exp == '')  No @endif</td>
        </tr>

        @if($applicant->agent_exp != null || $applicant->agent_exp != '')
        @php $agent_exp = json_decode( $applicant->agent_exp, true ); @endphp
        <tr>
            <td> &nbsp;  Position</td>
            <td> &nbsp;  {{ $agent_exp['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Address</td>
            <td> &nbsp;  {{ $agent_exp['address'] ?? '-'}}</td>
        </tr>
        <tr>
            <td> &nbsp;  Company Name</td>
            <td> &nbsp;  {{ $agent_exp['company_name'] ?? '-' }}</td>
        </tr>
        @endif

        <tr>
            <td> &nbsp;  Family member as an agent or a staff of Prudential?</td>
            <td> &nbsp;  @if($applicant->family_agent == null || $applicant->family_agent == '') No @endif</td>
        </tr>

        @if($applicant->family_agent != null || $applicant->family_agent != '')
        @php $family_agent = json_decode( $applicant->family_agent, true ); @endphp
        <tr>
            <td> &nbsp;  Name</td>
            <td> &nbsp;  {{ $family_agent['name'] }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Position</td>
            <td> &nbsp;  {{ $family_agent['position'] }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Agent Code</td>
            <td> &nbsp;  {{ $family_agent['agent_code'] }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Relation</td>
            <td> &nbsp;  {{ $family_agent['relation'] }}</td>
        </tr>
        <tr>
            <td> &nbsp;  NRC</td>
            <td> &nbsp;  {{ $family_agent['nrc'] }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="2"><b> &nbsp;  Training Details</b></td>
        </tr>
        <tr>
            <td> &nbsp;  E-learning URL</td>
            <td> &nbsp;  {{ $applicant->e_learning }}</td>
        </tr>
        <tr>
            <td> &nbsp;  User Name</td>
            <td> &nbsp;  {{ $applicant->username }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Password</td>
            <td> &nbsp;  {{ $applicant->password }}</td>
        </tr>
        @foreach($trainings as $module)
        <tr>
            <td> &nbsp;  {{ $module->name }}</td>
            @if ($applicant->trainings->contains('id', $module->id))
            <td> &nbsp;  Completed</td>
            @else
            <td> &nbsp;  Incompleted</td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td> &nbsp;  Exam Date</td>
            <td> &nbsp;  {{ $applicant->exam_date }}</td>
        </tr>
        <tr>
            <td> &nbsp;  License</td>
            <td> &nbsp;  {{ $applicant->license_no }}</td>
        </tr>
        <tr>
            <td colspan="2"><b> &nbsp;  Bank Information</b></td>
        </tr>
        <tr>
            <td> &nbsp;  Account Name</td>
            <td> &nbsp;  {{ $applicant->bank_account_name }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Account No</td>
            <td> &nbsp;  {{ $applicant->bank_account_no }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Bank Name</td>
            <td> &nbsp;  {{ $applicant->banK_name }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Swift Code</td>
            <td> &nbsp;  {{ $applicant->swift_code }}</td>
        </tr>
        <tr>
            <td> &nbsp; Assign To</td>
            <td>  &nbsp; 
            @if($applicant->assign_admin_id != '')
                {{ $applicant->admin->name}} |
            @endif

            @if($applicant->assign_bdm_id != '')
                {{ $applicant->bdm->name}} |
            @endif

            @if($applicant->assign_ma_id != '')
                {{ $applicant->ma->name}}
            @endif
            </td>
        </tr>
        <tr>
            <td> &nbsp;  Temporary ID</td>
            <td> &nbsp;  {{ $applicant->temp_id }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Agent Code</td>
            <td> &nbsp;  {{ $applicant->agent_code }}</td>
        </tr>
        <tr>
            <td> &nbsp;  Current Status</td>
            <td> &nbsp;  {{ $applicant->current_status }}</td>
        </tr>
        <tr>
            <td> &nbsp;  UTM Source</td>
            <td> &nbsp;  {{ $applicant->utm_source }}</td>
        </tr>
    </tbody>
</table>