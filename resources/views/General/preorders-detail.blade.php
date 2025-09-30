<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Detail Preorder | Rekatrack</title>
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body x-data="{ page: 'ecommerce', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
      x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
      :class="{'dark bg-gray-900': darkMode === true}">

@include('partials.preloader')

<div class="flex h-screen overflow-hidden">
  @include('Template.sidebar')

  <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
    @include('partials.overlay')
    @include('Template.header')

    <main>
      <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <div x-data="{ pageName: `Manajemen Preorder`, subPageName: 'Detail Preorder' }">
          @include('Template.breadcrumb')
        </div>

        <!-- Detail Info -->
        <div class="mb-6 px-4 grid grid-cols-12 gap-3">
          <div class="col-span-8 text-left">
            <div class="flex mb-3 gap-1">
              <p class="font-semibold">Partner:</p>
              <p class="font-normal">{{ $preorder->partner->company_name ?? '-' }}</p>
            </div>
            <div class="flex mb-3 gap-1">
              <p class="font-semibold">Proyek:</p>
              <p class="font-normal">{{ $preorder->project->project_name ?? '-' }}</p>
            </div>
          </div>
          <div class="col-span-4 text-left">
            <div class="flex mb-3 gap-1">
              <p class="font-semibold">Nomor PO:</p>
              <p class="font-normal">{{ $preorder->po_number }}</p>
            </div>
            <div class="flex mb-3 gap-1">
              <p class="font-semibold">Tanggal PO:</p>
              <p class="font-normal">{{ \Carbon\Carbon::parse($preorder->created_at)->format('d/m/Y') }}</p>
            </div>
          </div>
        </div>

        <!-- Tabel Barang -->
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
          <div class="max-w-full overflow-x-auto">
            <table class="min-w-full">
              <thead>
              <tr class="border-b border-gray-100 dark:border-gray-800">
                <th class="px-5 py-3">No</th>
                <th class="px-5 py-3">Nama Barang</th>
                <th class="px-5 py-3">Kode Barang</th>
                <th class="px-5 py-3">Qty PO</th>
                <th class="px-5 py-3">Satuan</th>
                <th class="px-5 py-3">Keterangan</th>
              </tr>
              </thead>
              <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
              @foreach($preorder->items as $index => $item)
                <tr>
                  <td class="px-5 py-4">{{ $index + 1 }}</td>
                  <td class="px-5 py-4">{{ $item->masterItem->item_name ?? '-' }}</td>
                  <td class="px-5 py-4">{{ $item->masterItem->item_code ?? '-' }}</td>
                  <td class="px-5 py-4">{{ $item->qty_po }}</td>
                  <td class="px-5 py-4">{{ $item->unit->name ?? '-' }}</td>
                  <td class="px-5 py-4">{{ $item->masterItem->description ?? '-' }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Aksi -->
        <div class="flex justify-end space-x-4 py-4">
          <a href="{{ route('preorders.edit', $preorder->id) }}"
             class="bg-gray-600 hover:bg-gray-500 text-white rounded-md px-3.5 py-2.5 text-sm font-semibold shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
            Edit Preorder
          </a>
        </div>
      </div>
    </main>
  </div>
</div>
</body>
</html>
