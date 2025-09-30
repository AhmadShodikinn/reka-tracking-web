@props([
    'action',
    'title' => 'Apakah Anda yakin?',
    'message' => 'Tindakan ini tidak dapat dibatalkan.',
])

<div x-data="{ show: false }" class="inline-block">
    <!-- Trigger -->
    <button
        @click="show = true"
        type="button"
        class="text-red-600 dark:text-red-400 hover:underline"
    >
        Hapus
    </button>

    <!-- Modal -->
    <div
        x-show="show"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div
            @click.away="show = false"
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-md p-6"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="scale-95 opacity-0"
            x-transition:enter-end="scale-100 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="scale-100 opacity-100"
            x-transition:leave-end="scale-95 opacity-0"
        >
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                {{ $title }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                {{ $message }}
            </p>

            <div class="flex justify-end gap-3">
                <button
                    @click="show = false"
                    type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                >
                    Batal
                </button>

                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700"
                    >
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
