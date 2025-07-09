<!doctype html>
<html lang="en" >
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Tambah Preorder | Rekatrack</title>
  </head>
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
      darkMode = JSON.parse(localStorage.getItem('darkMode'));
      $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))
    "
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
            <div x-data="{ pageName: 'Manajemen Preorder', subPageName: 'Tambah Preorder' }">
              @include('Template.breadcrumb')
            </div>

            <form method="POST" action="{{ route('preorders.store') }}">
              @csrf
              <div class="space-y-6">

                {{-- Data Preorder --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                  <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                      Data Preorder
                    </h3>
                  </div>
                  <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">

                  <!-- partner -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                      <div class="flex items-center space-x-4">
                        <label for="partner_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">
                          Partner <p class="text-red-500 inline">*</p>
                        </label>
                        <select
                          id="partner_id"
                          name="partner_id"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                          required
                        >
                          <option value="">-- Pilih Partner --</option>
                          @foreach ($partners as $partner)
                            <option value="{{ $partner->id }}" {{ old('partner_id') == $partner->id ? 'selected' : '' }}>
                              {{ $partner->company_name }}
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <!-- project -->
                      <div class="flex items-center space-x-4">
                        <label for="project_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">
                          Proyek <p class="text-red-500 inline">*</p>
                        </label>
                        <select
                          id="project_id"
                          name="project_id"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                          required
                        >
                          <option value="">-- Pilih Proyek --</option>
                          @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                              {{ $project->project_code }} - {{ $project->project_name }}
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <!-- nomor Po -->
                      <div class="flex items-center space-x-4">
                        <label for="po_number" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">
                          Nomor PO <p class="text-red-500 inline">*</p>
                        </label>
                        <input
                          type="text"
                          id="po_number"
                          name="po_number"
                          value="{{ old('po_number') }}"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                          required
                        />
                      </div>
                    </div>
                  </div>
                </div>

                <!-- data item -->
                @php
                    $oldItems = [];
                    if(old('master_item_id')) {
                        foreach(old('master_item_id') as $i => $val) {
                            $oldItems[] = [
                                'master_item_id' => old("master_item_id.$i"),
                                'unit_id' => old("unit_id.$i"),
                                'qty_po' => old("qty_po.$i"),
                                'information' => old("information.$i", ''),
                                'item_name' => '',
                                'description' => ''
                            ];
                        }
                    }

                    if (count($oldItems) === 0) {
                        $oldItems[] = [
                            'master_item_id' => '',
                            'unit_id' => '',
                            'qty_po' => '',
                            'information' => '',
                            'item_name' => '',
                            'description' => ''
                        ];
                    }
                @endphp


                <div 
                  x-data="{
                    totalItems: {{ count($oldItems) }},
                    items: {{ json_encode($oldItems) }},
                    masterItems: {{ $masterItems->toJson() }},
                    units: {{ $units->toJson() }},
                    
                    updateItemDetails(index) {
                        const selectedId = this.items[index].master_item_id;
                        const selected = this.masterItems.find(i => i.id == selectedId);

                        if (selected) {
                        this.items[index].item_name = selected.item_name;
                        this.items[index].description = selected.description;
                        } else {
                        this.items[index].item_name = '';
                        this.items[index].description = '';
                        }
                    }
                }"
                class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-5 sm:p-6"
                >
                  <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Data Item Preorder</h3>
                    <span>Total item: <span x-text="totalItems"></span></span>
                  </div>

                  <template x-for="(item, index) in items" :key="index">
                    <div class="space-y-4 mb-6 border-b border-gray-300 dark:border-gray-700 pb-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pb-6">

                        <!-- Kode Barang -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Kode Barang <span class="text-red-500">*</span></label>
                            <select
                            :name="'master_item_id[' + index + ']'"
                            x-model="item.master_item_id"
                            @change="updateItemDetails(index)"
                            required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                            >
                            <option value="">-- Pilih Kode Barang --</option>
                            <template x-for="mi in masterItems" :key="mi.id">
                                <option :value="mi.id" x-text="mi.item_code" :selected="mi.id == item.master_item_id"></option>
                            </template>
                            </select>
                        </div>

                        <!-- Nama Barang (readonly) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Barang</label>
                            <input type="text" :value="item.item_name" readonly
                            class="dark:bg-dark-900 shadow-theme-xs h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                            />
                        </div>

                        <!-- Deskripsi (readonly) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Deskripsi</label>
                            <input type="text" :value="item.description" readonly
                            class="dark:bg-dark-900 shadow-theme-xs h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                            />
                        </div>

                        <!-- Satuan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Satuan <span class="text-red-500">*</span></label>
                            <select
                            x-model="item.unit_id"
                            :name="'unit_id[' + index + ']'"
                            required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                            >
                            <option value="">-- Pilih Satuan --</option>
                            <template x-for="unit in units" :key="unit.id">
                                <option :value="unit.id" x-text="unit.name" :selected="unit.id == item.unit_id"></option>
                            </template>
                            </select>
                        </div>

                        <!-- Jumlah PO -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Jumlah PO <span class="text-red-500">*</span></label>
                            <input
                            type="number"
                            min="1"
                            :name="'qty_po[' + index + ']'"
                            x-model.number="item.qty_po"
                            required
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                            />
                        </div>

                        <!-- Informasi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Informasi</label>
                            <input
                            type="text"
                            :name="'information[' + index + ']'"
                            x-model="item.information"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                            />
                        </div>
                        </div>

                        <!-- Tombol Hapus -->
                        <div class="flex justify-end">
                        <button type="button"
                            @click="items.splice(index, 1); totalItems--"
                            :class="items.length <= 1 ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-500 hover:bg-red-400'"
                            :disabled="items.length <= 1"
                            class="rounded-md text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                        >
                            Hapus Item
                        </button>
                        </div>
                    </div>
                    </template>


                  <div class="flex justify-end">
                    <button
                        type="button"
                        @click="if (items.length < 10) {
                            items.push({ master_item_id:'', unit_id:'', qty_po:'', information:'' });
                            totalItems++;
                        }"
                        :class="items.length >= 10 ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-500 hover:bg-blue-400'"
                        :disabled="items.length >= 10"
                        class="rounded-md text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                        >
                        Tambah Item
                    </button>
                  </div>
                </div>

                <div class="flex justify-end space-x-2">
                  <button
                    type="submit"
                    class="rounded-lg bg-brand-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-brand-700 focus:outline-none"
                  >
                    Simpan
                  </button>
                  <a href="{{ route('preorders.index') }}"
                    class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-800 hover:bg-gray-50 focus:outline-none"
                  >
                    Batal
                  </a>
                </div>
              </div>
            </form>

          </div>
        </main>
      </div>
    </div>
  </body>
</html>
