<?php

namespace App\Interfaces;

interface ContractInterface
{
    public function createRawContract(int $applicant_id);

    public function resendContract(int $applicant_id);

    public function save(int $contract_id, string $pdf, string $agreement_no, string $applicant_sign, string $witness_name, string $witness_sign, int $version, int $applicant_id);

    public function isValidContract(string $applicant_uuid, int $contract_version);
}
