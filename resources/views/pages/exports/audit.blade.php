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
        @foreach($applicants as $applicant)
        @php
        $activities = DB::table('applicant_status')->select('status_id','current_status', 'name',
        'applicant_status.created_at')
        ->leftjoin('users', 'users.id', 'applicant_status.user_id')
        ->where('applicant_id', $applicant->id)
        ->get();
        @endphp
        <tr>
            <td>{{ $applicant->name }}</td>
            <td>{{ $applicant->nrc }}</td>
            <td>{{ $applicant->created_at }}</td>

            @foreach ($activities as $row)

            {{-- // Lead submitted date --}}
            @if($row->status_id == '1' && $row->current_status == 'lead')
            <td>{{ empty($row->created_at) ? "Approved" : "Pending" }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'lead')
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
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // Background Check Approve/Reject --}}

            {{-- // PRUDNA filter Passed/Failed --}}
            @if($row->status_id == '11' && $row->current_status == 'pmli_filter')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'pru_dna_test')
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // PRUDNA filter Passed/Failed --}}

            {{-- // Payment Approve/Reject --}}
            @if($row->status_id == '11' && $row->current_status == 'pmli_filter')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'pru_dna_test')
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- //Payment Approve/Reject --}}

            {{-- // Certification Passed/Failed --}}
            @if($row->status_id == '1' && $row->current_status == 'onboard')
            <td>Approved</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @elseif($row->status_id == '4' && $row->current_status == 'certification')
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
            <td>{{ $row->name }}</td>
            <td>{{ $row->created_at }}</td>
            @endif
            {{-- // Onboarding Approve/Reject --}}

            {{-- // Status change to Inactive --}}
            @if($row->status_id == '8' && $row->current_status == 'active')
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