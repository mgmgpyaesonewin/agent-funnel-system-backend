<?php

namespace App\Imports;

use App\Applicant;
use App\Partner;
use App\Status;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ApplicantsImport implements ToModel, WithHeadingRow
{
    /**
     * @return null|\Illuminate\Database\Eloquent\Model
     */
    public function model(array $row)
    {
        return Applicant::updateOrCreate(
            [
                'id' => $row['no'],
            ],
            [
                'name' => $row['name'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'gender' => 'Male' == $row['gender'] ? 1 : 0,
                'nrc' => $row['nrc'],
                'address' => $row['address'],
                'dob' => $row['dob'],
                'aml_check' => $row['aml_check'],
                'current_status' => $row['current_stage'],
                'status_id' => Status::where('title', $row['status'])->first()->id ?? null,
                'partner_id' => Partner::where('company_name', $row['partner'])->first()->partner ?? null,
            ],
        );
    }
}
