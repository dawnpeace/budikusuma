<?php

namespace App\Exports;

use App\FamilyCard;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class FamilyCardExport implements FromQuery, WithMapping, WithHeadings
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
        return FamilyCard::query()
            ->select("stored_family_cards.id_card", "address", "rt", "rw", "zip_code", "kelurahan", "kecamatan", "kabupaten", "provinsi", "name", "gender", "birthplace", 
            "birthdate", "religion", "education", "profession", "family_relation", "stored_family_cards.created_at")
            ->join("stored_family_card_members", "stored_family_cards.id", "stored_family_card_members.family_card_id")
            ->whereRaw("DATE(stored_family_cards.created_at) BETWEEN ? AND ?", [$this->startDate, $this->endDate]);
            
    }

    public function map($row) : array 
    {
        return [
            $row->id_card,
            $row->address,
            $row->rt,
            $row->rw,
            $row->zip_code,
            $row->kelurahan,
            $row->kecamatan,
            $row->kabupaten,
            $row->provinsi,
            $row->name,
            $row->gender,
            $row->birthplace,
            Carbon::createFromFormat('Y-m-d', $row->birthdate)->format('d-m-Y'),
            $row->religion,
            $row->education,
            $row->profession,
            $row->family_relation,
            Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d-m-Y'),
        ];
    }

    public function headings() : array
    {
        return [
            "No KK",
            "Alamat",
            "RT",
            "RW",
            "Kode Pos",
            "Kelurahan",
            "Kecamatan",
            "Kabupaten",
            "Provinsi",
            "Nama Anggota",
            "Jenis Kelamin",
            "Tempat Lahir",
            "Tanggal Lahir",
            "Agama",
            "Pendidikan",
            "Profesi",
            "Hubungan Keluarga",
            "Tanggal Arsip",
        ];
    }

}
