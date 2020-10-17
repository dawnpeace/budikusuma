<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class ChildIdentityCardExport implements FromQuery
{
    use Exportable;

    public function query()
    {

    }
}
