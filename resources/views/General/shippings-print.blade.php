<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            margin: 5mm;
        }
    </style>
</head>
<body class="font-sans">
    <div class="text-left">
        <!-- Header Section -->
        <div class="mb-4 flex justify-between items-start">
        <!-- Logo dan informasi perusahaan di kiri -->
            <div class="flex flex-col">
                <!-- Logo di kiri -->
                <img src="{{ asset('images/logo/logo-reka.png') }}" alt="Logo" class="mb-1" style="max-width: 150px;">
                
                <!-- Alamat dan informasi lainnya di bawah logo -->
                <div>
                    <p class="text-lg font-bold">PT Rekaindo Global Jasa</p>
                    <p class="text-xs font-regular">Jl. Candi Sewu No. 30, Madiun 63122</p>
                    <p class="text-xs font-regular">Telp. 0351-4773030</p>
                    <p class="text-xs font-regular">Email: sekretariat@ptrekaindo.co.id</p>
                </div>
            </div>

            <!-- QR Code di kanan -->
            <div class="flex justify-center items-center w-28 h-28">
                {{ $qrCode }}
            </div>
        </div>
        
        <hr class="border-t-2 border-gray-400">
        
        <div class="text-center mb-2">
            <h2 class="text-xl font-bold">SURAT JALAN</h2>
            <p class="text-lg font-bold">No: {{ $travelDocument->no_travel_document }}</p>
        </div>

        <!-- Informasi Pengiriman -->
        <div class="mb-6 px-2 gap-3">
            <div class="text-left">
                <div class="col-span-6 flex flex-col">
                <div class="flex flex-inline gap-1">
                    <p class="font-semibold w-20">Proyek</p>
                    <p class="font-normal">: {{ $travelDocument->project }}</p>
                </div>
                <div class="flex flex-inline gap-1">
                    <p class="font-semibold w-20">Kepada</p>
                    <p class="font-normal truncate hover:overflow-visible hover:whitespace-normal hover:text-ellipsis">: 
                    {{ $travelDocument->send_to }}
                    </p>
                </div>
                </div>

                <div class="col-span-6 flex flex-col gap-3">
                <div class="grid grid-cols-12 gap-4">
                    <!-- Kolom Kiri -->
                    <div class="flex flex-col col-span-6 justify-start">
                    <div class="flex flex-inline gap-1">
                        <p class="font-semibold w-20">Tanggal</p>
                        <p class="font-normal">: {{ \Carbon\Carbon::parse($travelDocument->date_no_travel_document)->format('d/m/Y') }}</p>
                    </div>
                    <div class="flex flex-inline gap-1">
                        <p class="font-semibold w-20">Halaman</p>
                        <p class="font-normal">: 1 dari 1</p>
                    </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="flex flex-col col-span-6 justify-start">
                    <div class="flex flex-inline gap-1">
                        <p class="font-semibold w-10">PO</p>
                        <p class="font-normal">: {{ $travelDocument->po_number }}</p>
                    </div>
                    <div class="flex flex-inline gap-1">
                        <p class="font-semibold w-10">Ref</p>
                        <p class="font-normal">: {{ $travelDocument->reference_number }}</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Tabel Barang -->
        <div class="table-container mt-2">
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-1 py-2 border border-gray-300 text-xs text-center">No</th>
                        <th class="px-6 py-2 border border-gray-300 text-xs text-center">Uraian/Diskripsi</th>
                        <th class="px-2 py-2 border border-gray-300 text-xs text-center whitespace-nowrap">Kode Barang</th>
                        <th class="px-1 py-2 border border-gray-300 text-xs text-center whitespace-nowrap">QTY Kirim</th>
                        <th class="px-1 py-2 border border-gray-300 text-xs text-center whitespace-nowrap">Total Kirim</th>
                        <th class="px-1 py-2 border border-gray-300 text-xs text-center whitespace-nowrap">QTY PO</th>
                        <th class="px-1 py-2 border border-gray-300 text-xs text-center">Satuan</th>
                        <th class="px-4 py-2 border border-gray-300 text-xs text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($travelDocument->items as $index => $item)
                        <tr>
                            <td class="px-1 py-2 border border-gray-300 text-xs text-center">{{ $index + 1 }}</td>
                            <td class="px-1 py-2 border border-gray-300 text-xs text-left">{{ $item->item_name }}</td>
                            <td class="px-1 py-2 border border-gray-300 text-xs text-center whitespace-nowrap">{{ $item->item_code }}</td>
                            <td class="px-1 py-2 border border-gray-300 text-xs text-center whitespace-nowrap">{{ $item->qty_send }}</td>
                            <td class="px-1 py-2 border border-gray-300 text-xs text-center whitespace-nowrap">{{ $item->total_send }}</td>
                            <td class="px-1 py-2 border border-gray-300 text-xs text-center whitespace-nowrap">{{ $item->qty_po }}</td>
                            <td class="px-1 py-2 border border-gray-300 text-xs text-center">{{ $item->unit }}</td>
                            <td class="px-1 py-2 border border-gray-300 text-xs text-center">{{ $item->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
