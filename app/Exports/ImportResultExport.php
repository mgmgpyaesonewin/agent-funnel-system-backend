<?php

namespace App\Exports;

use App\Applicant;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class ImportResultExport implements FromCollection, WithHeadings, WithTitle
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
            'Result'
        ];
    }

    public function title(): string
    {
        return 'Import Result';
    }
}
