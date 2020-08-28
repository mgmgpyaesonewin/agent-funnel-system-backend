<?php

namespace Modules\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class GraphExport implements FromCollection, WithHeadings{
    protected $data;

    public function __construct($data, $title)
    {
        $this->data = $data;
        $this->title = $title;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {

        return [
            ['Course Name', $this->title],
            ['Name', 'Phone'],
         ];
    }
}
