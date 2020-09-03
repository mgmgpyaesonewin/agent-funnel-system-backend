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
            <td>{{ DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-'}}</td>
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
            <td>Highest Qualification</td>
            <td>{{ $applicant->education }}</td>
        </tr>
    </tbody>
</table>