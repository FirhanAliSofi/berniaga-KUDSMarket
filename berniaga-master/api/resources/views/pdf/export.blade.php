<!DOCTYPE html>
<html>
<head>
    <title>Data Seller</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        .jurusan {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        .list {
            width: 30%;
        }
    </style>
</head>
<body>
    <center>
        <h1>DATA SELLER</h1>
    </center>

    <table> 
    <tbody>
    @foreach($data as $seller)
    <tr>
        <td class="list">Nama:</td>
        <td>{{ $seller['nama'] }}</td>
    </tr>
    <tr>
        <td class="list">Email:</td>
        <td>{{ $seller['email'] }}</td>
    </tr>
    <tr>
        <td class="list">Jenis Kelamin:</td>
        <td>{{ $seller['jenis_kelamin'] }}</td>4
    </tr>
    <tr>
        <td class="list">No Telp:</td>
        <td>{{ $seller['no_telp'] }}</td>
    </tr>
    <tr>
        <td class="list">Tanggal Lahir:</td>
        <td>{{ $seller['tanggal_lahir'] }}</td>
    </tr>
    <tr>
        <td class="list">NIK:</td>
        <td>{{ $seller['nik'] }}</td>
    </tr>
    <tr>
        <td class="list">Foto KTP:</td>
        <td>
            <img src="{{ public_path("storage/foto_ktp/".$seller['foto_ktp']) }}" alt="" style="width: 7cm; height: 4cm;">
        </td>
    </tr>
    <tr>
        <td class="list">Foto Wajah:</td>
        <td>
            <img src="{{ public_path("storage/foto_wajah/".$seller['foto_wajah']) }}" alt="" style="width: 7cm; height:4cm;">
        </td>    
    </tr>
    <tr>
        <td class="list">Alamat:</td>
        <td>{{ $seller['alamat_lengkap'] }}</td>
    </tr>
    <tr>
        <td class="list">Kodepos:</td>
        <td>{{ $seller['kodepos'] }}</td>
    </tr>
    <tr>
        <td class="list">Profesi:</td>
        <td>{{ $seller['profesi'] }}</td>
    </tr>
    <tr>
        <td class="list">Status Verfikasi:</td>
        <td>{{ $seller['status_verifikasi'] }}</td>
    </tr>
    <tr>
        <td class="list">Provinsi:</td>
        <td>{{ $seller['provinces'] }}</td>
    </tr>
    <tr>
        <td class="list">Kabupaten/Kota:</td>
        <td>{{ $seller['cities'] }}</td>
    </tr>
    <tr>
        <td class="list">Kecamatan:</td>
        <td>{{ $seller['district'] }}</td>
    </tr>
    <tr>
        <td class="list">Desa:</td>
        <td>{{ $seller['subdistrict'] }}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <center>
        <h1>DATA TOKO SELLER</h1>
    </center>
    {{-- Mulai Data Toko --}}
    <table> 
        <tbody>
        @foreach($toko as $t)
        <tr>
            <td class="list">Nama Toko:</td>
            <td>{{ $t['nama_toko'] }}</td>
        </tr>
        <tr>
            <td class="list">Alamat Toko:</td>
            <td>{{ $t['alamat_toko'] }}</td>
        </tr>
        <tr>
            <td class="list">Link Toko:</td>
            <td>{{ $t['link_toko'] }}</td>
        </tr>
        <tr>
            <td class="list">No Telp Toko:</td>
            <td>{{ $t['no_telp_toko'] }}</td>
        </tr>
        <tr>
            <td class="list">Kode Pos:</td>
            <td>{{ $t['kodepos'] }}</td>
        </tr>
        <tr>
            <td class="list">Jam Buka Toko:</td>
            <td>{{ $t['jam_buka'] }}</td>
        </tr>
        <tr>
            <td class="list">Jam Tutup Toko:</td>
            <td>{{ $t['jam_tutup'] }}</td>
        </tr>
        <tr>
            <td class="list">Jenis Usaha:</td>
            <td>{{ $t['jenis_usaha'] }}</td>
        </tr>
        <tr>
            <td class="list">Logo Toko:</td>
            <td>
                <img src="{{ public_path("storage/logo_toko/".$t['logo_toko']) }}" alt="" style="width: 7cm; height:4cm;">
            </td>    
        </tr>
        <tr>
            <td class="list">Foto Toko 1:</td>
            <td>
                <img src="{{ public_path("storage/foto_toko/".$t['foto_toko1']) }}" alt="" style="width: 7cm; height:4cm;">
            </td>    
        </tr>
        <tr>
            <td class="list">Foto Toko 2:</td>
            <td>
                <img src="{{ public_path("storage/foto_toko/".$t['foto_toko2']) }}" alt="" style="width: 7cm; height:4cm;">
            </td>    
        </tr>
        <tr>
            <td class="list">Foto Toko 3:</td>
            <td>
                <img src="{{ public_path("storage/foto_toko/".$t['foto_toko3']) }}" alt="" style="width: 7cm; height:4cm;">
            </td>    
        </tr>
        <tr>
            <td class="list">Deskripsi Toko:</td>
            <td>{{ $t['deskripsi'] }}</td>
        </tr>
        <tr>
            <td class="list">Status Toko:</td>
            <td>{{ $t['status'] }}</td>
        </tr>
        <tr>
            <td class="list">Saldo Toko:</td>
            <td>{{ $t['saldo'] }}</td>
        </tr>
        @endforeach
        </tbody>
        </table>
        
        <center>
            <img src="../public/koperasi urun dana.png" alt="Logo Koperasi" style="width: 5cm; height:5cm">
            <h3>Koperasi Urun Dana Sejahtera</h3>
        </center>
</body>
</html>
