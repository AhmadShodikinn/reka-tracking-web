<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Unit | Rekatrack</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  </head>
  <body
    x-data="{ page: 'unit', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
    x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
             $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{ 'dark bg-gray-900': darkMode === true }"
  >
    @include('partials.preloader')

    <div class="flex h-screen overflow-hidden">
      @include('Template.sidebar')

      <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
        @include('partials.overlay')
        @include('Template.header')

        <main>
          <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div x-data="{ pageName: 'Satuan Unit', subPageName: '' }">
              @include('Template.breadcrumb')
            </div>

            <!-- Tombol Tambah -->
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
              <a href="{{ route('units.add') }}"
                 class="rounded-md bg-blue-500 text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                Tambah Unit
              </a>
            </div>

            <!-- Tabel -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
              <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                  <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                      <th class="px-5 py-3 sm:px-6">
                        <p class="text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">No</p>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <p class="text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama Unit</p>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <p class="text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($units as $index => $unit)
                    <tr>
                      <td class="px-5 py-3 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                          {{ $loop->iteration + ($units->currentPage() - 1) * $units->perPage() }}
                        </p>
                      </td>
                      <td class="px-6 py-4 sm:px-6">
                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $unit->name }}</p>
                      </td>
                      <td class="px-6 py-4 sm:px-6">
                        <div class="flex space-x-2">
                          <a href="{{ route('units.edit', $unit->id) }}"
                             class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                          <form action="{{ route('units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus unit ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <!-- Pagination -->
                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 dark:border-gray-800 dark:bg-white/[0.03]">
                  <p class="text-sm text-gray-500 dark:text-gray-300 mb-2 sm:mb-0">
                    Menampilkan {{ $units->firstItem() }} ke {{ $units->lastItem() }} dari total {{ $units->total() }} data
                  </p>
                  <div>
                    {{ $units->links('pagination::tailwind') }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
</html>
