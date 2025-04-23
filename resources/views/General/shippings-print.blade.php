<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Jalan</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            margin: 5mm;
            font-family: 'Helvetica', 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        /* Hanya untuk tabel barang */
        .tabel-barang th, 
        .tabel-barang td {
            border: 1px solid #D1D5DB;
            font-size: 0.75rem;
            padding: 0.5rem 0.25rem;
        }

        /* Optional, jika tidak ingin latar belakang di header tabel */
        .tabel-barang th {
            background-color: #E5E7EB;
        }

        hr {
            border: none;
            border-top: 2px solid #9CA3AF;
        }

        .info-table td {
            vertical-align: top;
            padding: 0.25rem 0.5rem;
            border: 1px;
        }
        .info-table td:first-child {
            width: 5rem;
            font-weight: 600;
            border: 1px;
        }

        /* Styling untuk info pengiriman dengan dua kolom berdampingan */
        .info-container {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }
        .info-table-left, .info-table-right {
            width: 45%;
        }
        .info-table-left p, .info-table-right p {
            font-size: 0.75rem;
            font-weight: light;
            margin: 0;
        }
        .info-table-left .title, .info-table-right .title {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div style="text-align: left;">

        <!-- Header -->
        <table style="width: 100%; margin-bottom: 1rem;">
            <tr>
                <!-- Kiri: Logo dan Info Perusahaan -->
                <td style="width: 70%; vertical-align: top;">
                    <img src="{{ public_path('images/logo/logo-reka.png') }}" alt="Logo" style="max-width: 120px; margin-bottom: 0.5rem;">
                    <p style="font-size: 1rem; font-weight: bold; margin: 0;">PT Rekaindo Global Jasa</p>
                    <p style="font-size: 0.75rem; font-weight: light; margin: 0;">Jl. Candi Sewu No. 30, Madiun 63122</p>
                    <p style="font-size: 0.75rem; font-weight: light; margin: 0;">Telp. 0351-4773030</p>
                    <p style="font-size: 0.75rem; font-weight: light; margin: 0;">Email: sekretariat@ptrekaindo.co.id</p>
                </td>

                <!-- Kanan: QR Code -->
                <td style="width: 30%; text-align: right; vertical-align: top;">
                    <img src="data:image/png;base64, {!! $qrCode !!}" alt="QR Code" style="max-width: 100px; height: auto;">
                </td>
            </tr>
        </table>

        <hr>

        <!-- Judul Surat Jalan dan Nomor -->
        <div style="text-align: center;">
            <h2 style="font-size: 1.25rem; font-weight: bold; margin: 0;">SURAT JALAN</h2>
            <p style="font-size: 1.125rem; font-weight: bold; margin: 0;">No: {{ $travelDocument->no_travel_document }}</p>
        </div>

        <!-- Info Pengiriman dalam tabel -->
        <table style="width: 100%; margin-top: 1rem; margin-bottom: 1rem;">
            <tr>
                <!-- Tabel Kiri -->
                <td style="width: 50%; vertical-align: top; padding-right: 2rem;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 0.75rem; font-weight: bold; margin: 0;">Proyek</td>
                            <td style="font-size: 0.75rem; font-weight: light; margin: 0;">: {{ $travelDocument->project }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.75rem; font-weight: bold; margin: 0;">Kepada</td>
                            <td style="font-size: 0.75rem; font-weight: light; margin: 0;">: {{ $travelDocument->send_to }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.75rem; font-weight: bold; margin: 0;">Tanggal</td>
                            <td style="font-size: 0.75rem; font-weight: light; margin: 0;">: {{ \Carbon\Carbon::parse($travelDocument->date_no_travel_document)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 0.75rem; font-weight: bold; margin: 0;"">Jumlah Halaman</td>
                            <td style="font-size: 0.75rem; font-weight: light; margin: 0;"">: 1 dari 1</td>
                        </tr>
                    </table>
                </td>

                <!-- Tabel Kanan -->
                <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%;">
                <!-- hidden buat atur style -->
                <tr>
                    <td style="font-size: 0.75rem; font-weight: bold; margin: 0; color:white;">PO</td>
                    <td style="font-size: 0.75rem; font-weight: light; margin: 0; color:white;">: {{ $travelDocument->po_number }}</td>
                </tr>
                <tr>
                    <td style="font-size: 0.75rem; font-weight: bold; margin: 0; color:white;">Ref</td>
                    <td style="font-size: 0.75rem; font-weight: light; margin: 0; color:white;">: {{ $travelDocument->reference_number }}</td>
                </tr>

                <tr>
                    <td style="font-size: 0.75rem; font-weight: bold; margin: 0;">PO</td>
                    <td style="font-size: 0.75rem; font-weight: light; margin: 0;">: {{ $travelDocument->po_number }}</td>
                </tr>
                <tr>
                    <td style="font-size: 0.75rem; font-weight: bold; margin: 0;">Ref</td>
                    <td style="font-size: 0.75rem; font-weight: light; margin: 0;">: {{ $travelDocument->reference_number }}</td>
                </tr>
            </table>
                </td>
            </tr>
        </table>


        <!-- Tabel Barang -->
        <div style="margin-top: 0.5rem;">
            <table class="tabel-barang">
                <thead>
                    <tr>
                        <th style="text-align: center;">No</th>
                        <th style="text-align: center;">Uraian/Diskripsi</th>
                        <th style="text-align: center;">Kode Barang</th>
                        <th style="text-align: center;">QTY Kirim</th>
                        <th style="text-align: center;">Total Kirim</th>
                        <th style="text-align: center;">QTY PO</th>
                        <th style="text-align: center;">Satuan</th>
                        <th style="text-align: center;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($travelDocument->items as $index => $item)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td style="text-align: center;">{{ $item->item_code }}</td>
                            <td style="text-align: center;">{{ $item->qty_send }}</td>
                            <td style="text-align: center;">{{ $item->total_send }}</td>
                            <td style="text-align: center;">{{ $item->qty_po }}</td>
                            <td style="text-align: center;">{{ $item->unit }}</td>
                            <td style="text-align: center;">{{ $item->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
