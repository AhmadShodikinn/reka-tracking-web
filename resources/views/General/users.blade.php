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
              <div x-data="{ pageName: `Manajemen Pengguna`}">
                @include('Template.breadcrumb')
            </div>

            <!-- Start Tables -->
            <!-- Search Form -->
            <div class="mb-6 flex flex-wrap items-center justify-end gap-3">
              <div class="relative">
                <input
                  type="text"
                  placeholder="Search..."
                  id="search"
                  name="search"
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                />
                <svg
                  class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"
                  xmlns="http://www.w3.org/2000/svg" 
                  fill="none" 
                  viewBox="0 0 24 24" 
                  stroke-width="1.5" 
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round" 
                    stroke-linejoin="round"  
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                  />
                </svg>
              </div>
            </div>
            <!-- End Search Form -->
 
            <!-- Start Table Content -->
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
              <div class="max-w-full overflow-x-auto">
                <table class="min-w-full">
                  <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-800">
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nama Pengguna</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Alamat E-mail</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Nomor Telepon</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Role</p>
                        </div>
                      </th>
                      <th class="px-5 py-3 sm:px-6">
                        <div class="flex items-center">
                          <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p>
                        </div>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                  @foreach($users as $index => $user)
                      <tr>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $index + 1 }}</p> <!-- Nomor urut -->
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $user->name }}</p> <!-- Nama Pengguna -->
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $user->email }}</p> <!-- Alamat E-mail -->
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $user->phone_number }}</p> <!-- Nomor Telepon -->
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <p class="text-gray-500 text-theme-sm dark:text-gray-400">{{ $user->role->name }}</p> <!-- Role -->
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                              <div class="flex space-x-2">
                                  <!-- Tombol Aksi -->
                                  <!-- <a href="{{ route('users.update', ['id' => $user->id]) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a> -->
                                  <form action="{{ route('users.detail', ['id' => $user['id']]) }}" method="GET">
                                      <button type="submit" class="text-blue-600 dark:text-blue-400 hover:underline">
                                          Edit
                                      </button>
                                  </form>
                                  <form action="{{ route('users.destroy', ['id' => $user['id']]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                  </form>

                              </div>
                          </td>
                      </tr>
                  @endforeach

                  </tbody>
                </table>
              </div>
            </div>

            <!-- End Table Content -->


          </div>
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </body>

</html>
