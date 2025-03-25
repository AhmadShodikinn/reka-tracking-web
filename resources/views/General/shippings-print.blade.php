<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
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
    <div class="text-center">
        <!-- Header Section -->
        <img src="{{ asset('path-to-your-logo.png') }}" alt="Logo" class="mx-auto mb-4" style="max-width: 200px;">
        <p class="text-lg font-semibold mb-1">PT Rekaindo Global Jasa</p>
        <p class="mb-1">Alamat: Jl. Contoh Alamat No. 123, Jakarta</p>
        <p class="mb-1">Telp: (021) 123-4567</p>
        <p class="mb-4">Email: info@rekaglobal.co.id</p>
        
        <!-- Horizontal Line -->
        <hr class="border-t-2 border-gray-400 mb-6">
        
        <!-- Surat Jalan Section -->
        <h2 class="text-2xl font-bold mb-4">SURAT JALAN</h2>
        <p class="text-lg">No: <strong>{{ $suratJalanNo }}</strong></p> <!-- Laravel variable for Surat Jalan Number -->
    </div>
</body>
</html>
