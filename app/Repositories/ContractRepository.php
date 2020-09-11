<?php

namespace App\Repositories;

use App\Applicant;
use App\Contract;
use App\Interfaces\ContractInterface;
use Carbon\Carbon;
use Config;

class ContractRepository implements ContractInterface
{
    public function createRawContract(int $applicant_id): int
    {
        $contract = new Contract();
        $contract->version = Config::get('constants.contract.new_contract_version');
        $contract->applicant_id = $applicant_id;
        $contract->save();

        return $contract->version;
    }

    public function resendContract(int $applicant_id): int
    {
        $contract = new Contract();
        $contract->version = Contract::where('applicant_id', $applicant_id)->latest()->pluck('version')->first() + 1;
        $contract->applicant_id = $applicant_id;
        $contract->save();

        return $contract->version;
    }

    public function save(int $contract_id, string $pdf, string $agreement_no, string $applicant_sign, string $witness_name, string $witness_sign, int $version, int $applicant_id): int
    {
        $contract = Contract::find($contract_id);
        $contract->pdf = $pdf;
        $contract->agreement_no = $agreement_no;
        $contract->signed_date = Carbon::now();
        $contract->applicant_sign_img = $applicant_sign;
        $contract->witness_name = $witness_name;
        $contract->witness_sign_img = $witness_sign;
        $contract->version = $version;
        $contract->applicant_id = $applicant_id;
        $contract->save();

        return $contract->version;
    }

    public function isValidContract(string $applicant_uuid, int $contract_version)
    {
        $applicant = Applicant::where('uuid', $applicant_uuid)->first();

        return Contract::where('applicant_id', $applicant->id)->where('version', $contract_version)->exists();
    }
}
