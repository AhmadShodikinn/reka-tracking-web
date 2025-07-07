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
    <title>Manajemen Item | Rekatrack</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  </head>
  <body
    x-data="{ page: 'master-item', darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
    x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
             $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{ 'dark bg-gray-900': darkMode }"
  >
    @include('partials.preloader')

    <div class="flex h-screen overflow-hidden">
      @include('Template.sidebar')

      <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
        @include('partials.overlay')
        @include('Template.header')

        <main>
          <div class="p-4 mx-auto max-w-screen-2xl md:p-6">
            <div x-data="{ pageName: 'Master Item', subPageName: '' }">
              @include('Template.breadcrumb')
            </div>

            <!-- Tombol Tambah -->
            <div class="mb-6 flex justify-between items-center">
              <a href="{{ route('items.add') }}"
                class="rounded-md bg-blue-500 text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs hover:bg-blue-400">
                Tambah Item
              </a>
            </div>

            <!-- Tabel -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
              <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                  <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                      <th class="px-5 py-3 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">No</th>
                      <th class="px-5 py-3 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kode Item</th>
                      <th class="px-5 py-3 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama Item</th>
                      <th class="px-5 py-3 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Deskripsi</th>
                      <th class="px-5 py-3 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($masterItems as $index => $item)
                    <tr>
                      <td class="px-5 py-3 text-gray-500 text-theme-sm dark:text-gray-400">
                        {{ $loop->iteration + ($masterItems->currentPage() - 1) * $masterItems->perPage() }}
                      </td>
                      <td class="px-5 py-3 text-gray-800 text-theme-sm dark:text-gray-200">
                        {{ $item->item_code }}
                      </td>
                      <td class="px-5 py-3 text-gray-800 text-theme-sm dark:text-gray-200">
                        {{ $item->item_name }}
                      </td>
                      <td class="px-5 py-3 text-gray-800 text-theme-sm dark:text-gray-200">
                        {{ $item->description ?? '-' }}
                      </td>
                      <td class="px-5 py-3">
                        <div class="flex space-x-2">
                          <a href="{{ route('items.edit', $item->id) }}"
                             class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                          <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
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
                    Menampilkan {{ $masterItems->firstItem() }} ke {{ $masterItems->lastItem() }} dari total {{ $masterItems->total() }} data
                  </p>
                  <div>
                    {{ $masterItems->links('pagination::tailwind') }}
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
