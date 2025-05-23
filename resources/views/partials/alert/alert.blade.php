@if (session('success') || session('error') || session('warning') || session('info'))
  @php
    $types = ['success', 'error', 'warning', 'info'];
    $type = collect($types)->first(fn($t) => session()->has($t));
    $message = session($type);
  @endphp

  <div
    x-data="{ show: true, type: '{{ $type }}', message: '{{ $message }}' }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    :class="{
      'border-error-500 bg-error-50 dark:border-error-500/30 dark:bg-error-500/15': type === 'error',
      'border-success-500 bg-success-50 dark:border-success-500/30 dark:bg-success-500/15': type === 'success',
      'border-info-500 bg-info-50 dark:border-info-500/30 dark:bg-info-500/15': type === 'info',
      'border-warning-500 bg-warning-50 dark:border-warning-500/30 dark:bg-warning-500/15': type === 'warning'
    }"
    class="fixed top-5 right-5 rounded-xl border p-4 transition duration-500 z-50"
    x-transition:enter="transition ease-out duration-500 transform"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300 transform"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
  >
    <div class="flex items-start gap-3">
      <div :class="{
          'text-error-500': type === 'error',
          'text-success-500': type === 'success',
          'text-info-500': type === 'info',
          'text-warning-500': type === 'warning'
        }" class="-mt-0.5">
      </div>

      <div>
        <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90" x-text="type.charAt(0).toUpperCase() + type.slice(1) + ' Message'"></h4>
        <p class="text-sm text-gray-500 dark:text-gray-400" x-text="message"></p>
      </div>
    </div>
  </div>
@endif

@if ($errors->any())
  <div
    x-data="{ show: true, type: 'error', message: @js($errors->first()) }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    :class="{
    'border-error-500 bg-error-50 dark:border-error-500/30 dark:bg-error-500/15': type === 'error',
    'border-success-500 bg-success-50 dark:border-success-500/30 dark:bg-success-500/15': type === 'success',
    'border-info-500 bg-info-50 dark:border-info-500/30 dark:bg-info-500/15': type === 'info',
    'border-warning-500 bg-warning-50 dark:border-warning-500/30 dark:bg-warning-500/15': type === 'warning'
  }"
  class="fixed top-5 right-5 rounded-xl border p-4 transition duration-500 z-50 w-96"
  x-transition:enter="transition ease-out duration-500 transform"
  x-transition:enter-start="opacity-0 scale-95"
  x-transition:enter-end="opacity-100 scale-100"
  x-transition:leave="transition ease-in duration-300 transform"
  x-transition:leave-start="opacity-100 scale-100"
  x-transition:leave-end="opacity-0 scale-95"
  >
    <div class="flex items-start gap-3">
      <div :class="{
          'text-error-500': type === 'error'
        }" class="-mt-0.5">
      </div>

      <div>
        <h4 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white/90" x-text="type.charAt(0).toUpperCase() + type.slice(1) + ' Message'"></h4>
        <p class="text-sm text-gray-500 dark:text-gray-400" x-text="message"></p>
      </div>
    </div>
  </div>
@endif