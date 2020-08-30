<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Modules\Exports\GraphExport;

class MultiGraphExport implements WithMultipleSheets{
    protected $data;

    public function __construct($data1, $data2, $title)
    {
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->title = $title;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        // $sheets[0] = new GraphExport($this->data1, $this->title);
        // $sheets[1] = new GraphExport($this->data2, $this->title);

        // return $sheets;

        return [
            'Completed' => new GraphExport($this->data1, $this->title),
            'Assigned' => new GraphExport($this->data2, $this->title),
        ];
    }
}
