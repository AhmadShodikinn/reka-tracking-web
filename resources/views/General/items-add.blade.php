<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Item | Rekatrack</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  </head>
  <body
    x-data="{ page: 'item', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
    x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
             $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
  >
    @include('partials.preloader')

    <div class="flex h-screen overflow-hidden">
      @include('Template.sidebar')

      <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
        @include('partials.overlay')
        @include('Template.header')

        <main>
          <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <div x-data="{ pageName: 'Master Item', subPageName: 'Tambah Item' }">
              @include('Template.breadcrumb')
            </div>

            <div class="space-y-6">
              <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                  <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Tambah Item Baru</h3>
                </div>

                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                  <form method="POST" action="{{ route('items.store') }}">
                    @csrf

                    <!-- Item Code -->
                    <div class="pb-3">
                      <label for="item_code" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kode Item
                      </label>
                      <input
                        type="text"
                        name="item_code"
                        id="item_code"
                        placeholder="Contoh: ITM001"
                        value="{{ old('item_code') }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      />
                      @error('item_code')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Item Name -->
                    <div class="pb-3">
                      <label for="item_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Nama Item
                      </label>
                      <input
                        type="text"
                        name="item_name"
                        id="item_name"
                        placeholder="Contoh: Mouse Logitech"
                        value="{{ old('item_name') }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      />
                      @error('item_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Description -->
                    <div class="pb-3">
                      <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Deskripsi (Opsional)
                      </label>
                      <textarea
                        name="description"
                        id="description"
                        rows="3"
                        placeholder="Contoh: Item ini digunakan untuk keperluan kantor"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      >{{ old('description') }}</textarea>
                      @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end space-x-4">
                      <button type="submit"
                        class="rounded-md bg-blue-500 text-white px-4 py-2 text-sm font-semibold hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                        Simpan Item
                      </button>
                    </div>

                  </form>
                </div>
              </div>
            </div>

          </div>
        </main>
      </div>
    </div>
  </body>
</html>
