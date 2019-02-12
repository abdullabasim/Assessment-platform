<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CollectionExport implements FromCollection ,WithHeadings
{
    use Exportable;
    private $data;
    private $header;

    public function __construct($data,$header)
    {
        $this->data = $data;
        $this->header = $header;
    }
    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return $this->header;
    }

}
