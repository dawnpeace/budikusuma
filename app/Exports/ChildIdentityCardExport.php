<?php

namespace App\Exports;

use App\ChildIdentityCard;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChildIdentityCardExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    private $startDate;
    private $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }


    public function query()
    {
        return ChildIdentityCard::query();
    }

    public function map($row) : array
    {
        return [];
    }

    public function headings() : array
    {
        return [];
    }
}
