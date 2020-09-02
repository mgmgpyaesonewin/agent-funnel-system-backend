<table>
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $applicant->name }}</td>
        </tr>
        <tr>
            <td>Prefered Name</td>
            <td>{{ $applicant->email }}</td>
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
            <td>Gender</td>
            <td>{{ $applicant->gender }}</td>
        </tr>
        <tr>
            <td>Marital Status</td>
            <td>{{ ($applicant->married == '1' ? 'Married' : 'Single') }}</td>
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
            <td>{{ $applicant->email }}</td>
        </tr>
        <tr>
            <td>Township</td>
            <td>{{ $applicant->email }}</td>
        </tr>
        <tr>
            <td>Myanmar Citizen</td>
            <td>{{ ($applicant->myanmar_citizen == '1' ? 'Yes' : 'No') }}</td>
        </tr>
        <tr>
            <td>Race</td>
            <td>{{ $applicant->race }}</td>
        </tr>
        <tr>
            <td>Education</td>
            <td>{{ $applicant->education }}</td>
        </tr>
        <tr>
            <td colspan="2">Work Experience</td>
        </tr>
        @if($applicant->employment != null)
        @php $user = json_decode( $applicant->employment, true ); @endphp
        @foreach ($user as $exp)
        <tr>
            <td>Position</td>
            <td>{{ $exp['title'] }}</td>
        </tr>
        <tr>
            <td>Company Name</td>
            <td>{{ $exp['company'] }}</td>
        </tr>
        <tr>
            <td>Duration</td>
            <td>{{ $exp['start_date'] }} - {{ $exp['end_date'] }}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>