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
            margin: 20mm;
        }
    </style>
</head>
<body class="font-sans">
    <div class="text-left">
        <!-- Header Section -->
        <div class="mb-4">
            <!-- Logo di kiri -->
            <img src="{{ asset('images/logo/logo-reka.png') }}" alt="Logo" class="mb-2" style="max-width: 200px;">
            
            <!-- Alamat dan informasi lainnya di bawah logo -->
            <div>
                <p class="text-3xl font-bold">PT Rekaindo Global Jasa</p>
                <p class="text-base font-regular">Jl. Candi Sewu No. 30, Madiun 63122 </p>
                <p class="text-base font-regular">Telp. 0351-4773030</p>
                <p class="text-base font-regular">Email: sekretariat@ptrekaindo.co.id</p>
            </div>
        </div>
        
        <hr class="border-t-2 border-gray-400 mb-6">
        
        <div class="text-center">
            <h2 class="text-3xl font-bold">SURAT JALAN</h2>
            <p class="text-lg">No: <strong>{{ $travelDocument->no_travel_document }}</strong></p> <!-- Laravel variable for Surat Jalan Number -->
        </div>

        
    </div>
</body>
</html>
