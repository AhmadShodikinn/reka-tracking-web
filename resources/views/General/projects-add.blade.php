<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Proyek | Rekatrack</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  </head>
  <body
    x-data="{ page: 'projects', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
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
            <div x-data="{ pageName: 'Manajemen Proyek', subPageName: 'Tambah Proyek' }">
              @include('Template.breadcrumb')
            </div>

            <div class="space-y-6">
              <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                  <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Tambah Proyek Baru</h3>
                </div>

                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                  <form method="POST" action="{{ route('projects.store') }}">
                    @csrf

                    <!-- Kode Proyek -->
                    <div>
                      <label for="project_code" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kode Proyek
                      </label>
                      <input
                        type="text"
                        name="project_code"
                        id="project_code"
                        placeholder="Contoh: 612-CR"
                        value="{{ old('project_code') }}"
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      />
                      @error('project_code')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Nama Proyek -->
                    <div>
                      <label for="project_name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Nama Proyek
                      </label>
                      <input
                        type="text"
                        name="project_name"
                        id="project_name"
                        placeholder="Contoh: Pengadaan Kereta"
                        value="{{ old('project_name') }}"
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      />
                      @error('project_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Periode -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label for="start_date" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          Tanggal Mulai (opsional)
                        </label>
                        <input
                          type="date"
                          name="start_date"
                          id="start_date"
                          value="{{ old('start_date') }}"
                          class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                        />
                      </div>

                      <div>
                        <label for="end_date" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          Tanggal Selesai (opsional)
                        </label>
                        <input
                          type="date"
                          name="end_date"
                          id="end_date"
                          value="{{ old('end_date') }}"
                          class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                        />
                      </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                      <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Deskripsi (opsional)
                      </label>
                      <textarea
                        name="description"
                        id="description"
                        rows="3"
                        placeholder="Deskripsi proyek..."
                        class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      >{{ old('description') }}</textarea>
                      @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-4 pt-4">
                      <button type="submit"
                        class="rounded-md bg-blue-500 text-white px-4 py-2 text-sm font-semibold hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                        Simpan Proyek
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
