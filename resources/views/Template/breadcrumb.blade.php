<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
  <h2
    class="text-xl font-semibold text-gray-800 dark:text-white/90"
    x-text="subPageName ? subPageName : pageName"
  ></h2>

  <nav>
    <ol class="flex items-center gap-1.5">
      <li>
        <a
          class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
          href="index.html"
        >
          Home
          <svg
            class="stroke-current"
            width="17"
            height="16"
            viewBox="0 0 17 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
              stroke=""
              stroke-width="1.2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </a>
      </li>
      <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>

      <!-- Tampilkan subPageName jika ada -->
      <!-- <template x-if="!subPageName">
        <li class="text-sm text-gray-800 dark:text-white/90 flex items-center">
          SVG untuk pageName
          <svg
            class="stroke-current w-3 h-3 mr-1"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 6 6"
            fill="none"
          >
            <path
              d="M0.375 3h5.25M3 0.375v5.25"
              stroke-width="1.2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <span x-text="pageName"></span>
        </li>
      </template> -->
      
      <!-- Tampilkan subPageName jika ada -->
      <template x-if="subPageName">
        <li class="text-sm text-gray-800 dark:text-white/90 flex items-center">
          <!-- SVG untuk subPageName -->
          <svg
            class="stroke-current"
            width="17"
            height="16"
            viewBox="0 0 17 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
              stroke=""
              stroke-width="1.2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <span x-text="subPageName"></span>
        </li>
      </template>
    </ol>
  </nav>
</div>