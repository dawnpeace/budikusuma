<?php

namespace App\Exports;

use App\BirthCertificate;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class BirthCertificateExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    private $startDate;
    private $endDate;

    /**
     * @param Date startDate Y-m-d format
     * @param Date endDate Y-m-d format
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return BirthCertificate::query()
            ->whereRaw("DATE(created_at) BETWEEN ? AND ?", [$this->startDate, $this->endDate])
            ->oldest();
    }

    public function map($card) : array 
    {
        return [
            $card->id_card,
            $card->name,
            $card->gender,
            $card->mother_identity_card_number,
            $card->mother_name,
            $card->father_identity_card_number,
            $card->father_name,
            $card->birthplace,
            Carbon::createFromFormat('Y-m-d H:i:s', $card->birthdate)->format('d-m-Y'),
            Carbon::createFromFormat('Y-m-d H:i:s', $card->created_at)->format('d-m-Y'),
        ];
    }

    public function headings() : array
    {
        return [
            "No Identitas",
            "Nama",
            "Jenis Kelamin",
            "No Identitas Ibu",
            "Nama Ibu",
            "No Identitas Ayah",
            "Nama Ayah",
            "Tempat Lahir",
            "Tanggal Lahiir",
            "Tanggal Arsip"
        ];
    }
}
