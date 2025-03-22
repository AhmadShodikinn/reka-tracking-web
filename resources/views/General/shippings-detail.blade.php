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
      Detail Pengiriman | Rekatrack
    </title>
  </head>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  <body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
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
      <div
        class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto"
      >
        <!-- Small Device Overlay Start -->
        @include('partials.overlay')
        <!-- Small Device Overlay End -->

        <!-- ===== Header Start ===== -->
        @include('Template.header')
        <!-- ===== Header End ===== -->

        <!-- ===== Main Content Start ===== -->
        <main>
        <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div x-data="{ pageName: `Manajemen Pengiriman`, subPageName: 'Detail Pengiriman'}">
                @include('Template.breadcrumb')
            </div>

            <!-- Information Detail -->
            <div class="mb-6 px-6 grid grid-cols-12 gap-3">
                <div class="col-span-8 text-left">
                    <p class="font-medium">Kepada: {{ $travelDocument->send_to }}</p>
                    <p class="font-medium">Proyek: {{ $travelDocument->project }}</p>
                    <p class="font-medium">Tanggal SJN: {{ \Carbon\Carbon::parse($travelDocument->date_no_travel_document)->format('d/m/Y') }}</p>
                </div>
                <div class="col-span-4 text-left">
                    <p class="font-medium">Nomor SJN: {{ $travelDocument->no_travel_document }}</p>
                    <p class="font-medium">PO: {{ $travelDocument->po_number }}</p>
                    <p class="font-medium">Ref: {{ $travelDocument->reference_number }}</p>
                </div>
            </div>

            <!-- Start Tables -->
            <!-- Start Table Content -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
              <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                  <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Deskripsi</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kode Barang</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">QTY Kirim</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Total Kirim</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Satuan</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Keterangan</p>
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($travelDocument->items as $index => $item)
                        <tr>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $index + 1 }}</p> 
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $item->description }}</p>
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $item->item_code }}</p> 
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $item->qty_send }}</p>
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $item->total_send }}</p> 
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400"> {{ $item->qty_po }}</p>
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $item->information }}</p>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>

            <!-- End Table Content -->


          </div>
            
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </body>

</html>
