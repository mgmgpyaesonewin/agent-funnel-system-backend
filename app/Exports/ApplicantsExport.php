<?php

namespace App\Exports;

use App\Applicant;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ApplicantsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    private $from;
    private $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
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
            'Partner'
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
            $applicant->partner->company_name ?? '-'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Applicant::query()->with(['statuses', 'partner'])->select(
            'id',
            'uuid',
            'name',
            'phone',
            'email',
            'gender',
            'nrc',
            'address',
            'dob',
            'aml_check',
            'current_status',
            'status_id',
            'partner_id'
        );
    }
}
