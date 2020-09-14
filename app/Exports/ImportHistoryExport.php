<?php

namespace App\Exports;

use App\Applicant;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ImportHistoryExport implements FromCollection, WithMapping, WithHeadings, WithTitle
{
    use Exportable;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No',
            'Name',
            'Phone',
            'Email',
            'Gender',
            'NRC',
            'Address',
            'DOB',
            'AML Check',
            'Current Stage',
            'Status',
            'Partner',
        ];
    }

    public function map($applicant): array
    { 
        return [
            $applicant->uuid,
            $applicant->name,
            $applicant->phone,
            $applicant->email,
            $applicant->gender,
            $applicant->nrc,
            $applicant->address,
            $applicant->dob,
            $applicant->aml_check,
            $applicant->current_status,
            $applicant->statuses->last()->title ?? 'New',
            $applicant->partner->company_name ?? '-',
        ];
    }

    public function title(): string
    {
        return 'Before Import';
    }
}
