<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
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
    <!-- ===== Header Start ===== -->
    <div class="text-center mb-8">
      <img src="{{ asset('path-to-your-logo.png') }}" alt="Logo" class="mx-auto mb-4" style="max-width: 200px;">
      <p class="text-lg font-semibold mb-1">PT Rekaindo Global Jasa</p>
      <p class="mb-1">Alamat: Jl. Contoh Alamat No. 123, Jakarta</p>
      <p class="mb-1">Telp: (021) 123-4567</p>
      <p class="mb-4">Email: info@rekaglobal.co.id</p>
    </div>
    <!-- ===== Header End ===== -->

    <!-- ===== Horizontal Line Start ===== -->
    <hr class="border-t-2 border-gray-400 mb-6">
    <!-- ===== Horizontal Line End ===== -->

    <!-- ===== Surat Jalan Start ===== -->
    <div class="text-center mb-4">
      <h2 class="text-2xl font-bold mb-4">SURAT JALAN</h2>
      <p class="text-lg">No: <strong>{{ $suratJalanNo }}</strong></p>
    </div>
    <!-- ===== Surat Jalan End ===== -->

    <!-- Optionally: Add more content if necessary -->
    <!-- For example: table or list items -->
  </body>
</html>
