<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Proyek | Rekatrack</title>
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
            <div x-data="{ pageName: 'Manajemen Proyek', subPageName: 'Edit Proyek' }">
              @include('Template.breadcrumb')
            </div>

            <div class="space-y-6">
              <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                  <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Edit Data Proyek</h3>
                </div>

                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                  <form method="POST" action="{{ route('projects.update', $project->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Kode Proyek -->
                    <div>
                      <label for="project_code" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kode Proyek
                      </label>
                      <input
                        type="text"
                        id="project_code"
                        name="project_code"
                        value="{{ old('project_code', $project->project_code) }}"
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
                        id="project_name"
                        name="project_name"
                        value="{{ old('project_name', $project->project_name) }}"
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      />
                      @error('project_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Tanggal -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <label for="start_date" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          Tanggal Mulai
                        </label>
                        <input
                          type="date"
                          id="start_date"
                          name="start_date"
                          value="{{ old('start_date', $project->start_date) }}"
                          class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                        />
                      </div>

                      <div>
                        <label for="end_date" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          Tanggal Selesai
                        </label>
                        <input
                          type="date"
                          id="end_date"
                          name="end_date"
                          value="{{ old('end_date', $project->end_date) }}"
                          class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                        />
                      </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                      <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Deskripsi
                      </label>
                      <textarea
                        id="description"
                        name="description"
                        rows="3"
                        class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      >{{ old('description', $project->description) }}</textarea>
                      @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-4 pt-4">
                      <button
                        type="submit"
                        class="rounded-md bg-blue-500 text-white px-4 py-2 text-sm font-semibold hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                      >
                        Update Proyek
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
