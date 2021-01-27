<?php

namespace App\Exports;

use App\Applicant;
use Carbon\Carbon;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PruDnaAmlCheckApplicantsExport implements FromQuery, WithHeadings, WithMapping
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
            "Applicant's Name(as per NRC)",
            'Preferred Name',
            'Phone Number',
            'Gender',
            'DOB',
            'Citizenship',
            'Current Employment-Position Held',
            'NRC No.',
            'Country',
            'Address',
            'Township',
            'City',
            'Region/State',
            'Agent Status',
        ];
    }

    public function map($applicant): array
    {
        return [
            $applicant->name,
            $applicant->preferred_name,
            $applicant->phone,
            $applicant->gender,
            $applicant->dob,
            0 == $applicant->myanmar_citizen ? 'Myanmar' : 'Other',
            $this->getCurrentPositionHeld($applicant->employment),
            $applicant->nrc,
            'Myanmar', // TODO: extract from database
            $applicant->address,
            DB::table('township_descriptions')->where('townships_id', $applicant->township_id)->first()->description_name ?? '-', // TODO: change to model
            DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-', // TODO: change to model
            DB::table('city_descriptions')->where('c_id', $applicant->city_id)->first()->name ?? '-', // TODO: ?? Region is same
            'active' == $applicant->current_status ? (8 != $applicant->status_id ? 'inactive' : 'active' )  : $applicant->current_status ,
        ];
    }

    public function getCurrentPositionHeld($employment)
    {
        if ($this->validateData($employment)) {
            $employment = json_decode($employment);
            foreach ($employment as $emp) {
                if ($this->isValidEmploymentDate($emp->duration_to_date)) {
                    return $emp->company_name;
                }
            }
        }

        return '-';
    }

    public function validateData($employment)
    {
        $employment = json_decode($employment);
        if (isset($employment) && count($employment) >= 0) {
            return true;
        }

        // Invalid Date
        return false;
    }

    public function isValidEmploymentDate($date)
    {
        $date = Carbon::parse($date);

        return $date->isCurrentMonth() || $date->gte(Carbon::now());
    }

    public function query()
    {
        return Applicant::query()->with(['statuses', 'partner'])->whereBetween('created_at', [Carbon::parse($this->from), Carbon::parse($this->to)])->select(
            'id',
            'uuid',
            'name',
            'preferred_name',
            'phone',
            'email',
            'gender',
            'nrc',
            'address',
            'dob',
            'aml_check',
            'current_status',
            'status_id',
            'partner_id',
            'employment',
            'township_id',
            'city_id'
        );
    }
}
