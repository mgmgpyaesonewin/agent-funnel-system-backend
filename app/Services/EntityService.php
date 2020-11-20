<?php

namespace App\Services;

use App\Services\Interfaces\EntityServiceInterface;
use Carbon\Carbon;

class EntityService implements EntityServiceInterface
{
    public function generateEntityFileName(string $type): string
    {
        $datetime = Carbon::now()->format('yymd_Hm');
        $filetype = 'txt';
        return "cust_{$type}_DEV_{$datetime}_PMLI.{$filetype}";
    }
}
