<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\ImportHistoryExport;
use App\Exports\ImportResultExport;

class ImportBackupExport implements WithMultipleSheets{
    protected $data;

    public function __construct($data1, $data2)
    {
        $this->data1 = $data1;
        $this->data2 = $data2;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {

        return [
            'Before Import' => new ImportHistoryExport($this->data1),
            'Import Result' => new ImportResultExport($this->data2),
        ];
    }
}
