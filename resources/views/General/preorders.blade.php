<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Preorder | Rekatrack</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body x-data="{ page: 'ecommerce', loaded: true, darkMode: false, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
      x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
      :class="{'dark bg-gray-900': darkMode === true}">

@include('partials.preloader')

<div class="flex h-screen overflow-hidden">
    @include('Template.sidebar')

    <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
        @include('partials.overlay')
        @include('Template.header')

        <main>
            <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                <div x-data="{ pageName: `Manajemen Preorder`, subPageName: '' }">
                    @include('Template.breadcrumb')
                </div>

                <!-- Tombol Tambah -->
                <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                    <a href="{{ route('preorders.create') }}"
                       class="rounded-md bg-blue-500 text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                        Tambah Preorder
                    </a>
                </div>

                <!-- Tabel -->
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] px-4 sm:px-6">
                    <div class="max-w-full overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3">No</th>
                                <th class="px-5 py-3">Nomor PO</th>
                                <th class="px-5 py-3">Partner</th>
                                <th class="px-5 py-3">Proyek</th>
                                <th class="px-5 py-3">Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach($preorders as $index => $preorder)
                                <tr>
                                    <td class="px-5 py-4">{{ $preorders->firstItem() + $index }}</td>
                                    <td class="px-5 py-4">{{ $preorder->po_number }}</td>
                                    <td class="px-5 py-4">{{ $preorder->partner->company_name ?? '-' }}</td>
                                    <td class="px-5 py-4">{{ $preorder->project->project_name ?? '-' }}</td>
                                    <td class="px-5 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('preorders.detail', $preorder->id) }}"
                                               class="text-blue-600 dark:text-blue-400 hover:underline">Detail</a>
                                            <form action="{{ route('preorders.destroy', $preorder->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus preorder ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 dark:text-red-400 hover:underline">Hapus</button>
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
                                Menampilkan {{ $preorders->firstItem() }} ke {{ $preorders->lastItem() }} dari total {{ $preorders->total() }} preorder
                            </p>
                            <div>
                                {{ $preorders->links('pagination::tailwind') }}
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
