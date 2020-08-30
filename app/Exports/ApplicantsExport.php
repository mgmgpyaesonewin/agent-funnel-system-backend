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
            'Current Stage',
            'Status',
            'Partner',
        ];
    }

    public function map($applicant): array
    {
        return [
            $applicant->id,
            $applicant->name,
            $applicant->phone,
            $applicant->email,
            $applicant->gender,
            $applicant->nrc,
            $applicant->address,
            $applicant->dob,
            $applicant->current_status,
            $applicant->statuses->last()->title ?? '-',
            $applicant->partner->company_name ?? '-',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Applicant::query()->with(['statuses', 'partner'])->select(
            'id',
            'name',
            'phone',
            'email',
            'gender',
            'nrc',
            'address',
            'dob',
            'current_status',
            'status_id',
            'partner_id'
        );
    }
}
