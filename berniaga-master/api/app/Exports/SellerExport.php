<?php

namespace App\Exports;

use App\Models\SellerModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


class SellerExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return SellerModel::with('provinces', 'cities', 'subdistrict', 'district')
            ->join('provinces', 'seller.id_province', '=', 'prov_id')
            ->join('cities', 'seller.id_cities', '=', 'city_id')
            ->join('districts', 'seller.id_district', '=', 'dis_id')
            ->join('subdistricts', 'seller.id_subdistrict', '=', 'subdis_id')
            ->select('seller.*', 'provinces.prov_name', 'cities.city_name', 'subdistricts.subdis_name', 'districts.dis_name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'No Telp',
            'NIK',
            'Profesi',
            'Alamat Lengkap',
            'Kelurahan/Desa',
            'Kecamatan',
            'Kabupaten/Kota',
            'Provinsi',
            'Kode Pos',
            'Foto KTP',
            'Foto Wajah',
            'Status Verifikasi',
        ];
    }

    public function map($seller): array
    {
        $fotoKtpUrl = $seller->foto_ktp ? url(Storage::url('foto_ktp/' . $seller->foto_ktp)) : null;
        $fotoWajahUrl = $seller->foto_wajah ? url(Storage::url('foto_wajah/' . $seller->foto_wajah)) : null;
        return [
            $seller->id,
            $seller->nama,
            $seller->email,
            $seller->jenis_kelamin,
            $seller->tanggal_lahir,
            $seller->no_telp,
            $seller->nik,
            $seller->profesi,
            $seller->alamat_lengkap,
            $seller->subdistrict->subdis_name,
            $seller->district->dis_name,
            $seller->cities->city_name,
            $seller->provinces->prov_name,
            $seller->kodepos,
            $this->createHyperlink($fotoKtpUrl),
            $this->createHyperlink($fotoWajahUrl),
            $seller->status_verifikasi,
        ];
    }

    private function createHyperlink($url)
    {
        if ($url) {
            return '=HYPERLINK("' . $url . '", "Foto")';
        }

        return null;
    }   
}