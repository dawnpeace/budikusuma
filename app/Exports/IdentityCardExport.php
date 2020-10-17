<?php

namespace App\Exports;

use App\enums\Translator;
use App\IdentityCard;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IdentityCardExport implements FromQuery, WithMapping, WithHeadings
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
        return IdentityCard::query()
            ->whereRaw("DATE(created_at) BETWEEN ? AND ?", [$this->startDate, $this->endDate])
            ->orderBy('created_at');
            
    }

    public function map($card) : array
    {
        return [
            $card->identity_card_number,
            $card->name,
            $card->gender,
            $card->address,
            $card->birthplace,
            Carbon::createFromFormat('Y-m-d H:i:s', $card->birthdate)->format('d-m-Y'),
            $card->rt,
            $card->rw,
            $card->kelurahan,
            $card->kecamatan,
            $card->religion,
            Translator::marriageStatus($card->marriage_status),
            $card->profession,
            $card->nationality,
            Carbon::createFromFormat('Y-m-d H:i:s', $card->created_at)->format('d-m-Y'),
        ];
    }

    public function headings() : array
    {
        return [
            "No Identitas",
            "Nama",
            "Jenis Kelamin",
            "Alamat",
            "Tempat Lahir",
            "Tanggal Lahir",
            "RT",
            "RW",
            "Kelurahan",
            "Kecamatan",
            "Agama",
            "Status Pernikahan",
            "Pekerjaan",
            "Kewarganegaraan",
            "Tanggal Arsip",
        ];
    }

    public function getResult()
    {
        return $this->query()->get();
    }
}
