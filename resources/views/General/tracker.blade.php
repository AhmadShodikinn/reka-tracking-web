<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        Manajemen Pengiriman | Rekatrack
    </title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode'));
        $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
>
    @include('partials.preloader')
    <div class="flex h-screen overflow-hidden">
        @include('Template.sidebar')
        <div
            class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto"
        >
            @include('partials.overlay')
            @include('Template.header')
            <main class="relative">
                <div class="absolute top-0 left-0 z-10 w-full h-[50px] p-2 bg-white bg-opacity-70 rounded-md shadow-lg">
                    <input
                        type="text"
                        id="search"
                        placeholder="Cari Paket Pengiriman..."
                        class="w-full h-full px-4 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200 dark:focus:ring-blue-500"
                    />
                </div>

                <div id="map" class="h-[600px] w-full mt-[50px] relative"></div>
            </main>


        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        var center = [-7.61617286255246, 111.52143728913316];

        // Inisialisasi peta dengan Leaflet
        var map = L.map("map").setView(center, 10); 

        // Menambahkan layer OpenStreetMap
        L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 18,
        }).addTo(map);

        // Menambahkan marker pada posisi tertentu
        L.marker(center).addTo(map);
    </script>

</body>
</html>
