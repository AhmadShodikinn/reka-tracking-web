<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Mitra | Rekatrack</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  </head>
  <body
    x-data="{ page: 'partner', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
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
            <div x-data="{ pageName: 'Partner', subPageName: '' }">
              @include('Template.breadcrumb')
            </div>

            <!-- Tombol Tambah -->
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
              <a href="{{ route('partners.create') }}"
                 class="rounded-md bg-blue-500 text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                Tambah Mitra
              </a>
            </div>

            <!-- Tabel -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
              <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                  <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                      <th class="px-5 py-3 sm:px-6 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">No</th>
                      <th class="px-5 py-3 sm:px-6 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama Perusahaan</th>
                      <th class="px-5 py-3 sm:px-6 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Email</th>
                      <th class="px-5 py-3 sm:px-6 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Telepon</th>
                      <th class="px-5 py-3 sm:px-6 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kontak</th>
                      <th class="px-5 py-3 sm:px-6 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Alamat Perusahaan</th>
                      <th class="px-5 py-3 sm:px-6 text-start font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($partners as $index => $partner)
                    <tr>
                      <td class="px-5 py-3 sm:px-6 text-gray-500 text-theme-sm dark:text-gray-400">
                        {{ $loop->iteration + ($partners->currentPage() - 1) * $partners->perPage() }}
                      </td>
                      <td class="px-6 py-4 sm:px-6 text-gray-500 text-theme-sm dark:text-gray-400">
                        {{ $partner->company_name }}
                      </td>
                      <td class="px-6 py-4 sm:px-6 text-gray-500 text-theme-sm dark:text-gray-400">
                        {{ $partner->company_email }}
                      </td>
                      <td class="px-6 py-4 sm:px-6 text-gray-500 text-theme-sm dark:text-gray-400">
                        {{ $partner->company_phone }}
                      </td>
                      <td class="px-6 py-4 sm:px-6 text-gray-500 text-theme-sm dark:text-gray-400">
                        {{ $partner->contact_name }}
                      </td>
                      <td class="px-6 py-4 sm:px-6 text-gray-500 text-theme-sm dark:text-gray-400">
                        {{ $partner->company_address }}
                      </td>
                      <td class="px-6 py-4 sm:px-6">
                        <div class="flex space-x-2">
                          <a href="{{ route('partners.edit', $partner->id) }}"
                             class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a>
                          @include('partials.modal.confirm-delete', [
                              'action' => route('partners.destroy', $partner['id']),
                              'title' => 'Hapus Data Ini?'
                          ])
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

                <!-- Pagination -->
                <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 dark:border-gray-800 dark:bg-white/[0.03]">
                  <p class="text-sm text-gray-500 dark:text-gray-300 mb-2 sm:mb-0">
                    Menampilkan {{ $partners->firstItem() }} ke {{ $partners->lastItem() }} dari total {{ $partners->total() }} data
                  </p>
                  <div>
                    {{ $partners->links('pagination::tailwind') }}
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
