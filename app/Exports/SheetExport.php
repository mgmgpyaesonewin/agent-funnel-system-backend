<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SheetExport implements FromCollection, WithHeadings{
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
            ['Title', $this->title],
            ['Name', 'Phone'],
         ];
    }
}
