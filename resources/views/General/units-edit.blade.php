<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Unit | Rekatrack</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  </head>

  <body
    x-data="{ page: 'unit', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
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
            <div x-data="{ pageName: 'Satuan Unit', subPageName: 'Edit Unit' }">
              @include('Template.breadcrumb')
            </div>

            <div class="space-y-6">
              <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                  <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Edit Data Unit</h3>
                </div>

                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                  <form method="POST" action="{{ route('units.update', $unit->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="pb-3">
                      <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Nama Unit
                      </label>
                      <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $unit->name) }}"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      />
                      @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                      <button
                        type="submit"
                        class="rounded-md bg-blue-500 text-white px-4 py-2 text-sm font-semibold hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                      >
                        Update Unit
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
