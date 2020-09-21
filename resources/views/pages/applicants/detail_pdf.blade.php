<table width="100%" cellpadding="4" cellspacing="6" style="width:100%">
    <tbody>
        <tr>
            <td colspan="2" align="center" style="height:27px;vertical-align: center;background-color:#b7b7b4"><b> &nbsp;  APPLICATION FORM</b></td>
        </tr>
        <tr>
            <td colspan="2" style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"><b> &nbsp;  Personal Information</b></td>
        </tr>      
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Name</b></td>
            <td> &nbsp;  {{ $applicant->name }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center">  &nbsp; <b>Prefered Name</b></td>
            <td> &nbsp;  {{ $applicant->preferred_name }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Phone</b></td>
            <td>  &nbsp; {{ $applicant->phone }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Secondary Phone</b></td>
            <td>  &nbsp; {{ $applicant->secondary_phone }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Prefered Name</b></td>
            <td> &nbsp;  {{ $applicant->email }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center">  &nbsp; <b>Gender</b></td>
            <td>  &nbsp; {{ $applicant->gender }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center">  &nbsp; <b>Marital Status</b></td>
            <td>  &nbsp; {{ $applicant->married }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>NRC</b></td>
            <td> &nbsp;  {{ $applicant->nrc }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>DOB</b></td>
            <td> &nbsp;  {{ $applicant->dob }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Address</b></td>
            <td> &nbsp;  {{ $applicant->address }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>City</b></td>
            <td> &nbsp;  {{ DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-' }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Township</b></td>
            <td> &nbsp; 
                 {{ DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-'}}
            </td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Citizenship</b></td>
            <td> &nbsp;  {{ ($applicant->myanmar_citizen == '1' ? 'Myanmar' : 'Other') }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Race</b></td>
            <td> &nbsp;  {{ $applicant->race }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Highest Qualification</b></td>
            <td> &nbsp;  {{ $applicant->education }}</td>
        </tr>
        @php $info = json_decode( $applicant->additional_info, true ); @endphp
        @if($info)
        @foreach ($info as $key => $val)
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>{{ $key }}</b></td>
            <td> &nbsp;  {{ $info[$val] }}</td>
        </tr>
        @endforeach
        @endif
        <tr>
            <td  colspan="2" style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"><b> &nbsp;  Declaration</b></td>
        </tr>        
        
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Spouse Name</b></td>
            <td> &nbsp;  {{ $applicant->spouse_name }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Spouse NRC</b></td>
            <td> &nbsp;  {{ $applicant->spouse_nrc }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Occupation</b></td>
            <td> &nbsp;  {{ $applicant->spouse_occupation }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Work at</b></td>
            <td> &nbsp;  {{ $applicant->spouse_company_name }}</td>
        </tr>
        <tr>
            <td colspan="2" style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"> &nbsp;  <b>Was a staff of Prudential?</b></td>            
        </tr>
        @if($applicant->prudential_agency_exp != null || $applicant->prudential_agency_exp != '')
        @php $employment = json_decode( $applicant->prudential_agency_exp, true ); @endphp
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Position</b></td>
            <td> &nbsp;  {{ $employment['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Department</b></td>
            <td> &nbsp;  {{ $employment['department_name'] ?? '-'}}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Start Date</b></td>
            <td> &nbsp;  {{ $employment['duration_from_date'] ?? '-' }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>End Date</b></td>
            <td> &nbsp;  {{ $employment['duration_to_date'] ?? '-' }}</td>
        </tr>
        @else
        <tr>
            <td colspan="2" >  &nbsp; 
                 @if($applicant->prudential_agency_exp == null || $applicant->prudential_agency_exp == '') No @endif
            </td>
        </tr>
        @endif
        <tr>
            <td colspan="2" style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"> &nbsp;  <b>Current and past employment details</b></td>            
        </tr>
        @php $emp = json_decode( $applicant->employment, true ); @endphp
        @if($applicant->employment != null|| $applicant->employment != '')
        @foreach ($emp as $employment)
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Position</b></td>
            <td> &nbsp;  {{ $employment['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Department</b></td>
            <td> &nbsp;  {{ $employment['department_name'] ?? '-'}}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Start Date</b></td>
            <td> &nbsp;  {{ $employment['duration_from_date'] ?? '-' }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>End Date</b></td>
            <td> &nbsp;  {{ $employment['duration_to_date'] ?? '-' }}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="2"> &nbsp; 
                 @if($applicant->employment == null || $applicant->employment == '') No Experience  @endif
            </td>
        </tr>
        @endif

        <tr>
            <td  colspan="2" style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"> &nbsp;  <b>Have any selling experience or acted as an agent?</b></td>   
        </tr>

        @if($applicant->agent_exp != null || $applicant->agent_exp != '')
        @php $agent_exp = json_decode( $applicant->agent_exp, true ); @endphp
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Position</b></td>
            <td> &nbsp;  {{ $agent_exp['position'] ?? '-' }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Address</b></td>
            <td> &nbsp;  {{ $agent_exp['address'] ?? '-'}}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Company Name</b></td>
            <td> &nbsp;  {{ $agent_exp['company_name'] ?? '-' }}</td>
        </tr>
        @else
        <tr>
            <td colspan="2"> &nbsp;  @if($applicant->agent_exp == null || $applicant->agent_exp == '')  No @endif</td>
        </tr>
        @endif

        <tr>
            <td colspan="2" style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"> &nbsp;  <b>Family member as an agent or a staff of Prudential?</b></td>
            
        </tr>

        @if($applicant->family_agent != null || $applicant->family_agent != '')
        @php $family_agent = json_decode( $applicant->family_agent, true ); @endphp
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Name</b></td>
            <td> &nbsp;  {{ $family_agent['name'] }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Position</b></td>
            <td> &nbsp;  {{ $family_agent['position'] }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Agent Code</b></td>
            <td> &nbsp;  {{ $family_agent['agent_code'] }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Relation</b></td>
            <td> &nbsp;  {{ $family_agent['relation'] }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>NRC</b></td>
            <td> &nbsp;  {{ $family_agent['nrc'] }}</td>
        </tr>
        @else
        <tr>
            <td colspan="2"> &nbsp;  @if($applicant->family_agent == null || $applicant->family_agent == '') No @endif</td>
        </tr>
        @endif
        <tr>
            <td colspan="2" style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"><b> &nbsp;  Training Progress</b></td>
        </tr>
        @foreach($trainings as $module)
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  {{ $module->name }}</td>
            @if ($applicant->trainings->contains('id', $module->id))
            <td style="height:17px;vertical-align: center"> &nbsp;  Completed</td>
            @else
            <td style="height:17px;vertical-align: center"> &nbsp;  Incompleted</td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td colspan="2"  style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"><b> &nbsp;  Bank Information</b></td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Account Name</b></td>
            <td> &nbsp;  {{ $applicant->bank_account_name }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Account No</b></td>
            <td> &nbsp;  {{ $applicant->bank_account_no }}</td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Bank Name</b></td>
            <td> &nbsp;  {{ $applicant->banK_name }}</td>
        </tr>     
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Swift Code</b></td>
            <td> &nbsp;  {{ $applicant->swift_code }}</td>
        </tr>        
        <tr>
            <td colspan="2"  style="background-color:#ed1b36;color:#fff;height:22px;vertical-align: center"><b> &nbsp;  For INTERNAL USE</b></td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Agree to Terms and Condition </b></td>
            <td> &nbsp; {{ ( ($applicant->nrc != '' && $applicant->city != '') ? 'Yes' : '-') }} </td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Agree that the information provided is true and correct</b> </td>
            <td> &nbsp;  {{ ( ($applicant->nrc != '' && $applicant->city != '') ? 'Yes' : '-') }} </td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp; <b>Assign To</b></td>
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
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Agent Code</b> </td>
            <td> &nbsp;  {{ $applicant->agent_code}} </td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>UTM Source</b> </td>
            <td> &nbsp;  {{ $applicant->utm_source}} </td>
        </tr>
        <tr>
            <td style="height:17px;vertical-align: center"> &nbsp;  <b>Current Status</b> </td>
            <td> &nbsp;  {{ strtoupper($applicant->current_status)}} </td>
        </tr>
    </tbody>
</table>