<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
      Lacak Pengiriman | Rekatrack
    </title>

    <!-- Link untuk Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="anonymous">

    <!-- Link untuk Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css">

    <!-- Vite CSS & JS -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
  </head>
  <body
    x-data="{ map: null, initialLocation: @json($initialLocation), locations: @json($locations), routeControl: null }"
    x-init="
      map = L.map('map').setView([initialLocation[0], initialLocation[1]], 13);
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '
      }).addTo(map);
      
      let latlngs = locations.map(loc => [loc.latitude, loc.longitude]);
      routeControl = L.Routing.control({
        waypoints: latlngs.map(latlng => L.latLng(latlng)),
        routeWhileDragging: true,
        createMarker: function() {} // Menyembunyikan marker waypoint
      }).addTo(map);

      let lastLatLng = latlngs[latlngs.length - 1];
      L.marker(lastLatLng).addTo(map).bindPopup('Tujuan Pengiriman');
    "
  >
    <!-- ===== Preloader Start ===== -->
    @include('partials.preloader')
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
      <!-- ===== Sidebar Start ===== -->
      @include('Template.sidebar')
      <!-- ===== Sidebar End ===== -->

      <!-- ===== Content Area Start ===== -->
      <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
        <!-- Small Device Overlay Start -->
        @include('partials.overlay')
        <!-- Small Device Overlay End -->

        <!-- ===== Header Start ===== -->
        @include('Template.header')
        <!-- ===== Header End ===== -->

        <!-- ===== Main Content Start ===== -->
        <main>
          <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div id="map" style="height: 500px;"></div> <!-- Tempat peta akan ditampilkan -->
          </div>
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </body>
</html>
