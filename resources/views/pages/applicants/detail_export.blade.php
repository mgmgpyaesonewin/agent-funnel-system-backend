<table>
    <tbody>
        <tr>
            <td>Name</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Prefered Name</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>{{ $user->phone }}</td>
        </tr>
        <tr>
            <td>Secondary Phone</td>
            <td>{{ $user->secondary_phone }}</td>
        </tr>
        <tr>
            <td>Gender</td>
            <td>{{ $user->gender }}</td>
        </tr>
        <tr>
            <td>Marital Status</td>
            <td>{{ ($applicant->married == '1' ? 'Married' : 'Single') }}</td>
        </tr>
        <tr>
            <td>NRC</td>
            <td>{{ $user->nrc }}</td>
        </tr>
        <tr>
            <td>DOB</td>
            <td>{{ $user->dob }}</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>{{ $user->address }}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Township</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>City</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Myanmar Citizen</td> 
            <td>{{ ($applicant->myanmar_citizen == '1' ? 'Yes' : 'No') }}</td>
        </tr>
        <tr>
            <td>Race</td>
            <td>{{ $user->race }}</td>
        </tr>
        <tr>
            <td>Education</td>
            <td>{{ $user->education }}</td>
        </tr>
        <tr>
            <td colspan="2">Work Experience</td>
        </tr>
        @if($user->employment != null)
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