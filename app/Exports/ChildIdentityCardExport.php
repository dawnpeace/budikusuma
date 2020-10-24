<?php

namespace App\Exports;

use App\ChildIdentityCard;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

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
        return [
            $row->card_number,
            $row->name,
            $row->gender,
            $row->family_card_number,
            $row->birth_certificate_number,
            $row->birthplace,
            Carbon::createFromFormat('Y-m-d  H:i:s', $row->birthdate)->format('d-m-Y'),
            $row->address,
            $row->householder_name,
            $row->religion,
            $row->rt,
            $row->rw,
            $row->kelurahan,
            $row->kecamatan,
            $row->citizenship,
            Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d-m-Y'),
        ];
    }

    public function headings() : array
    {
        return [
            "No KIA",
            "Nama",
            "Jenis Kelamin",
            "No KK",
            "No Akta Lahir",
            "Tempat Lahir",
            "Tanggal Lahir",
            "Alamat",
            "Nama Kepala Keluarga",
            "Agama",
            "RT",
            "RW",
            "Kelurahan",
            "Kecamatan",
            "Kewarganegaraan",
            "Tanggal Arsip"
        ];
    }
}
