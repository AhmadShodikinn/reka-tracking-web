<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profil | Rekatrack</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
  </head>
  <body
    x-data="{ page: 'profile', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
    x-init="
      darkMode = JSON.parse(localStorage.getItem('darkMode'));
      $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))
    "
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
            <div x-data="{ pageName: 'Profil', subPageName: 'Edit Profil' }">
              @include('Template.breadcrumb')
            </div>

            <div class="space-y-6">
              <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                  <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Edit Profil Saya</h3>
                </div>

                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                  <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="pb-3">
                      <label class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">Nama Lengkap</label>
                      <input
                        type="text"
                        name="fullname"
                        value="{{ old('fullname', auth()->user()->name) }}"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 placeholder:text-gray-400 dark:placeholder:text-white/30 focus:outline-none focus:ring-3 shadow-theme-xs dark:focus:border-brand-800 focus:border-brand-300 focus:ring-brand-500/10"
                      />
                    </div>

                    <div class="pb-3">
                      <label class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">NIP</label>
                      <input
                        type="text"
                        name="nip"
                        value="{{ old('nip', auth()->user()->nip) }}"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 placeholder:text-gray-400 dark:placeholder:text-white/30 focus:outline-none focus:ring-3 shadow-theme-xs dark:focus:border-brand-800 focus:border-brand-300 focus:ring-brand-500/10"
                      />
                    </div>

                    <div class="pb-3">
                      <label class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">E-mail</label>
                      <input
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 placeholder:text-gray-400 dark:placeholder:text-white/30 focus:outline-none focus:ring-3 shadow-theme-xs dark:focus:border-brand-800 focus:border-brand-300 focus:ring-brand-500/10"
                      />
                    </div>

                    <div class="pb-3">
                      <label class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">Nomor Telephone</label>
                      <input
                        type="text"
                        name="telephone"
                        value="{{ old('telephone', auth()->user()->phone_number) }}"
                        class="h-11 w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 placeholder:text-gray-400 dark:placeholder:text-white/30 focus:outline-none focus:ring-3 shadow-theme-xs dark:focus:border-brand-800 focus:border-brand-300 focus:ring-brand-500/10"
                      />
                    </div>

                    <div class="flex justify-end space-x-4">
                      <button
                        type="submit"
                        class="rounded-md bg-blue-500 text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                      >
                        Simpan Perubahan
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
