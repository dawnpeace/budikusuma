<?php

namespace App\Exports;

use App\DeathCertificate;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class DeathCertificateExport implements FromQuery, WithMapping, WithHeadings
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
        return DeathCertificate::query()
            ->whereRaw("DATE(created_at) BETWEEN ? AND ?", [$this->startDate, $this->endDate])
            ->oldest();
    }

    public function map($card): array
    {
        return [
            $card->card_number,
            $card->identity_number,
            $card->name,
            $card->gender,
            $card->birthdate,
            $card->birthplace,
            $card->deceased_at,
            $card->note
        ];
    }

    public function headings(): array
    {
        return [
            "No Akta",
            "No Identitas",
            "Nama Alm.",
            "Jenis Kelamin",
            "Tanggal Lahir",
            "Tempat Lahir",
            "Wafat pada",
            "Keterangan"
        ];
    }

}
