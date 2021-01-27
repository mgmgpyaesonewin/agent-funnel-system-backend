<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>NRC no.</th>
            <th>Lead submitted date</th>
            <th>Approve/Reject</th>
            <th>Update by</th>
            <th>Date</th>
            <th>Background Check Approve/Reject</th>
            <th>Update by</th>
            <th>Date</th>
            <th>PRUDNA filter Passed/Failed</th>
            <th>Update by</th>
            <th>Date</th>
            <th>AML Passed/Failed</th>
            <th>Update by</th>
            <th>Date</th>
            <th>Payment Approve/Reject</th>
            <th>Update by</th>
            <th>Date</th>
            <th>Certification Passed/Failed</th>
            <th>Update by</th>
            <th>Date</th>
            <th>Onboarding Approve/Reject</th>
            <th>Update by</th>
            <th>Date</th>
            <th>Status change to Inactive</th>
            <th>Update by</th>
            <th>Date</th>
            <th>Status change to Ceased Association</th>
            <th>Update by</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
    @php
    $payment = DB::table('settings')->select('meta_value')
    ->where('meta_key', 'payment_mandatory')
    ->first();
    @endphp

        @foreach($applicants as $applicant)
        @php
        $activities = DB::table('applicant_status')->select('status_id','current_status', 'name',
        'applicant_status.created_at')
        ->leftjoin('users', 'users.id', 'applicant_status.user_id')
        ->where('applicant_id', $applicant->id)
        ->groupby('applicant_id', 'current_status', 'status_id')
        ->get();
        @endphp
        <tr>
            <td>{{ $applicant->name }}</td>
            <td>{{ $applicant->nrc }}</td>
            <td>{{ $applicant->created_at }}</td>

            @foreach ($activities as $row)

            {{-- // Lead submitted date --}}
            @if($row->status_id == '1' && $row->current_status == 'bop_session')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'lead')
            <td>Rejected</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // Lead submitted date --}}

            {{-- // Background Check Approve/Reject --}}
            @if($row->status_id == '1' && $row->current_status == 'pru_dna_test')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'pre_filter')
            <td>Rejected</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // Background Check Approve/Reject --}}

            {{-- // PRUDNA filter Passed/Failed --}}
            @if($row->status_id == '5' && $row->current_status == 'pru_dna_test')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'pru_dna_test')
            <td>Rejected</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // PRUDNA filter Passed/Failed --}}

            {{-- // AML Check Passed/Failed --}}
            @if($row->status_id == '3' && $row->current_status == 'pmli_filter' && $applicant->aml_check == 'Passed')
            <td>Passed</td>
            <td>-</td>
            <td>-</td> 
            @elseif($row->status_id == '3' && $row->current_status == 'pmli_filter' && $applicant->aml_check == 'Failed')
            <td>Failed</td>
            <td>-</td>
            <td></td> 
            @endif
            {{-- // AML Check Passed/Failed --}}

            {{-- // Payment Approve/Reject --}}
            @if($row->status_id == '3' && $row->current_status == 'pmli_filter' && $applicant->payment != '' )
            <td>Approved</td>
            <td>-</td>
            <td>-</td>
            @elseif($row->status_id == '3' && $row->current_status == 'pmli_filter' && $applicant->payment == '')
            <td>-</td>
            <td>-</td>
            <td>-</td>
            @endif            
            {{-- //Payment Approve/Reject --}}

            {{-- // Certification Passed/Failed --}}
            @if($row->status_id == '1' && $row->current_status == 'onboard')
            <td>Passed</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'certification')
            <td>Failed</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // Certification Passed/Failed --}}

            {{-- // Onboarding Approve/Reject --}}
            @if($row->status_id == '8' && $row->current_status == 'active')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'onboard')
            <td>Rejected</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // Onboarding Approve/Reject --}}

            {{-- // Status change to Inactive --}}
            @if($row->status_id == '9' && $row->current_status == 'active')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // Status change to Inactive --}}

            {{-- // Status change to Ceased Association --}}
            @if($row->status_id == '10' && $row->current_status == 'active')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // Status change to Ceased Association --}}

            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>