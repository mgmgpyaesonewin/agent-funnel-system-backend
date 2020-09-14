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
            'AML Check',
            'Current Stage',
            'Status',
            'Partner',
            'Registered At',
            'Background Check',
            'Pru DNA Filter',
            'PMLI Filter',
            'Payment Made At',
            'Training Started At',
            'Certification',
            'Onboarding',
            'Contract Active',
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
            $applicant->statuses()->wherePivot('status_id', 1)->wherePivot('current_status', 'lead')->first()->pivot->created_at ?? '-',
            $applicant->statuses()->wherePivot('status_id', 1)->wherePivot('current_status', 'pre_filter')->first()->pivot->created_at ?? '-',
            $applicant->statuses()->wherePivot('status_id', 1)->wherePivot('current_status', 'pru_dna_test')->first()->pivot->created_at ?? '-',
            $applicant->statuses()->wherePivot('status_id', 5)->wherePivot('current_status', 'pru_dna_test')->first()->pivot->created_at ?? '-',
            $applicant->statuses()->wherePivot('status_id', 11)->wherePivot('current_status', 'pmli_filter')->first()->pivot->created_at ?? '-',
            $applicant->statuses()->wherePivot('status_id', 3)->wherePivot('current_status', 'training')->first()->pivot->created_at ?? '-',
            $applicant->statuses()->wherePivot('status_id', 3)->wherePivot('current_status', 'pmli_filter')->first()->pivot->created_at ?? '-',
            $applicant->statuses()->wherePivot('status_id', 1)->wherePivot('current_status', 'onboard')->first()->pivot->created_at ?? '-',
            $applicant->statuses()->wherePivot('status_id', 8)->wherePivot('current_status', 'active')->first()->pivot->created_at ?? '-'
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
