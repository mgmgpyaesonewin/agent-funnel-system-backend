<?php

namespace App\Imports;

use App\Applicant;
use App\Partner;
use App\Status;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ImportHistoryExport;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterImport;

class ApplicantsImport implements ToModel, WithHeadingRow
{ 
    use Importable;

    private $rows = [];

    /**
     * @return null|\Illuminate\Database\Eloquent\Model
     */
    public function model(array $row)
    {

        $result= Applicant::updateOrCreate(
            [
                'uuid' => $row['no'],
            ],
            [
                'name' => $row['name'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'gender' => 'Male' == $row['gender'] ? 1 : 0,
                'nrc' => $row['nrc'],
                'address' => $row['address'],
                'dob' => $row['dob'],
                'aml_check' => ('Passed' == $row['aml_check'] ? 1 : ('Pending' == $row['aml_check'] ? 0 : 2)), 
                'current_status' => $row['current_stage'],
                'status_id' => Status::where('title', $row['status'])->first()->id ?? null,
                'partner_id' => Partner::where('company_name', $row['partner'])->first()->partner ?? null,
            ],
        );
        $row['result'] = ($result->isDirty() ? 'Fail' : (count($result->getChanges()) > 0 ? 'Success' : 'No Changes Made') );
        array_push($this->rows,$row);
        
    }

    public function getImportResult(): array
    { 
        return $this->rows;
    }
}
