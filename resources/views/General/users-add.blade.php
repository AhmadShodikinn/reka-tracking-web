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
      Manajemen Pengguna | Rekatrack
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
          <div x-data="{ 
              pageName: 'Manajemen Pengguna', 
              subPageName: 'Tambah Pengguna'}">
              @include('Template.breadcrumb')
          </div>

            <div class="">
              <div class="space-y-6">
                <div
                  class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                  <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3
                      class="text-base font-medium text-gray-800 dark:text-white/90">
                      Data pengguna
                    </h3>
                  </div>
                  <div
                    class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                    <form method="POST" action="{{ route('users.store') }}">
                      @csrf
                      <!-- Elements -->
                      <div class="pb-3">
                        <label
                          class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          Nama Lengkap
                        </label>
                        <input
                          type="text"
                          id="fullname"
                          name="fullname"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        />
                      </div>

                      <div class="pb-3">
                        <label
                          class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          NIP
                        </label>
                        <input
                          type="text"
                          id="nip"
                          name="nip"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        />
                      </div>

                      <!-- Elements -->
                      <div class="pb-3">
                        <label
                          class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          E-mail
                        </label>
                        <input
                          type="email"
                          placeholder="info@gmail.com"
                          id="email"
                          name="email"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        />
                      </div>

                      <!-- Elements -->
                      <div class="pb-3">
                        <label
                          class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          Nomor Telephone
                        </label>
                        <input
                          type="text"
                          id="telephone"
                          name="telephone"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        />
                      </div>

                      <!-- Elements -->
                      <div class="pb-3">
                        <label
                          class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                          Pilih Role
                        </label>
                        <div
                          x-data="{ isOptionSelected: false }"
                          class="relative z-20 bg-transparent">
                          <select
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                            id="role"
                            name="role"
                            @change="isOptionSelected = true">
                            <option
                              value=""
                              class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                              Select Option
                            </option>
                            
                            <!-- Loop data roles -->
                            @foreach ($roles as $role)
                              <option
                                value="{{ $role->id }}"
                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                {{ $role->name }}  <!-- Menampilkan nama role -->
                              </option>
                            @endforeach
                          </select>
                          <span
                            class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400"
                          >
                            <svg
                              class="stroke-current"
                              width="20"
                              height="20"
                              viewBox="0 0 20 20"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396"
                                stroke=""
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                              />
                            </svg>
                          </span>
                        </div>
                      </div>

                      <!-- Elements -->
                       <div class="justify-end flex space-x-4">
                         <button
                           type="submit"
                           class="rounded-md bg-blue-500 text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                         >
                           Tambah Pengguna
                         </button>
                       </div>
                    </form>
                  </div>
                </div>
              </div>

         
            </div>
          
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </body>

</html>
