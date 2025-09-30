<!doctype html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta 
    name="viewport" 
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" 
    />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>
    Edit Preorder | Rekatrack
    </title>
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body
  x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
  x-init="$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark bg-gray-900': darkMode}"
>
  @include('partials.preloader')
  <div class="flex h-screen overflow-hidden">
    @include('Template.sidebar')

    <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
      @include('partials.overlay')
      @include('Template.header')

      <main>
        <div class="p-4 mx-auto max-w-7xl md:p-6">

          <div x-data="{ pageName: 'Manajemen Preorder', subPageName: 'Edit Preorder' }">
            @include('Template.breadcrumb')
          </div>

          <form method="POST" action="{{ route('preorders.update', $preorder->id) }}" class="space-y-6" x-data="{
            partner_id: '{{ old('partner_id', $preorder->partner_id) }}',
            project_id: '{{ old('project_id', $preorder->project_id) }}',
            po_number: '{{ old('po_number', $preorder->po_number) }}',
            items: {{ Js::from(old('master_item_id', $itemsMapped->map(fn($item) => [
              'masterItemId' => $item['masterItemId'],
              'itemCode' => $item['itemCode'],
              'itemName' => $item['itemName'],
              'description' => $item['description'],
              'unitType' => $item['unitType'],
              'qtyPreOrder' => $item['qtyPreOrder'],
              'information' => $item['information'],
            ])->toArray())) }},
            masterItems: {{ Js::from($masterItems->map(fn($item) => [
              'id' => $item->id,
              'itemCode' => $item->item_code,
              'itemName' => $item->item_name,
              'description' => $item->description,
              'unitId' => $item->unit_id,
              'unitName' => $item->unit->name ?? '-',
            ])) }},
            units: {{ Js::from($units->map(fn($unit) => ['id' => $unit->id, 'name' => $unit->name])) }},

            addItem() {
              this.items.push({
                masterItemId: '',
                itemCode: '',
                itemName: '',
                description: '',
                unitType: '',
                qtyPreOrder: '',
                information: ''
              });
            },

            removeItem(index) {
              this.items.splice(index, 1);
            },

            updateItemDetails(index) {
              let selected = this.masterItems.find(m => m.id == this.items[index].masterItemId);
              if (selected) {
                this.items[index].itemCode = selected.itemCode;
                this.items[index].itemName = selected.itemName;
                this.items[index].description = selected.description;
              } else {
                this.items[index].itemCode = '';
                this.items[index].itemName = '';
                this.items[index].description = '';
              }
            }
          }"
          @submit="$nextTick(() => { items.forEach((item, idx) => updateItemDetails(idx)) })"
          >
            @csrf
            @method('PUT')

            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-6 space-y-6">

            <!-- partner -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                <label for="partner_id" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Partner <span class="text-red-500">*</span></label>
                <select id="partner_id" name="partner_id" x-model="partner_id" required
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                  <option value="">-- Pilih Partner --</option>
                  @foreach($partners as $partner)
                    <option value="{{ $partner->id }}" :selected="partner_id == '{{ $partner->id }}'">{{ $partner->company_name }}</option>
                  @endforeach
                </select>
                @error('partner_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
              </div>

              <!-- project -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                <label for="project_id" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Project <span class="text-red-500">*</span></label>
                <select id="project_id" name="project_id" x-model="project_id" required
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                  <option value="">-- Pilih Project --</option>
                  @foreach($projects as $project)
                    <option value="{{ $project->id }}" :selected="project_id == '{{ $project->id }}'">{{ $project->project_name }} ({{ $project->project_code }})</option>
                  @endforeach
                </select>
                @error('project_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
              </div>

              <!-- preorder number -->
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
                <label for="po_number" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nomor PO <span class="text-red-500">*</span></label>
                <input id="po_number" name="po_number" x-model="po_number" required type="text"
                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                />
                @error('po_number')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
              </div>
            </div>

            <!-- Items Section -->
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-6 mt-6">

              <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Item Preorder</h3>
            </div>

              <template x-for="(item, index) in items" :key="index">
                <div class="space-y-4 mb-6 border-b border-gray-300 pb-4 ">

                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pb-6">
                    <!-- Item Code -->
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Kode Barang <span class="text-red-500">*</span></label>
                      <select
                        :name="'master_item_id[' + index + ']'"
                        x-model="item.masterItemId"
                        @change="updateItemDetails(index)"
                        required
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                      >
                        <option value="">-- Pilih Kode Barang --</option>
                        <template x-for="mi in masterItems" :key="mi.id">
                          <option :value="mi.id" x-text="mi.itemCode" :selected="mi.id == item.masterItemId"></option>
                        </template>
                      </select>
                      @error('master_item_id.*')<p class="text-red-500 text-sm mt-1" x-text="$errors['master_item_id.'+index]"></p>@enderror
                    </div>

                    <!-- Item Name (readonly) -->
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Barang</label>
                      <input type="text" :value="item.itemName" readonly
                        class="dark:bg-dark-900 shadow-theme-xs h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                      />
                    </div>

                    <!-- Description (readonly) -->
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Deskripsi</label>
                      <input type="text" :value="item.description" readonly
                        class="dark:bg-dark-900 shadow-theme-xs h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                      />
                    </div>

                    <!-- Unit (readonly) -->
                    <div>
                    <label :for="'unit_id[' + index + ']'" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Satuan <span class="text-red-500">*</span>
                    </label>
                    <select
                        x-model="item.unitType"
                        :name="'unit_id[' + index + ']'"
                        required
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                    >
                        <option value="">--pilih satuan--</option>
                        <template x-for="unit in units" :key="unit.id">
                        <option :value="unit.id" x-text="unit.name" :selected="unit.id == item.unitType"></option>
                        </template>
                    </select>
                    </div>


                    <!-- Qty Preorder -->
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-400">Qty Preorder <span class="text-red-500">*</span></label>
                      <input
                        type="number"
                        min="1"
                        :name="'qty_preorder[' + index + ']'"
                        x-model.number="item.qtyPreOrder"
                        required
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 rounded-lg border border-gray-300 px-4 py-2.5 text-sm text-gray-800 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 w-full"
                      />
                      @error('qty_preorder.*')<p class="text-red-500 text-sm mt-1" x-text="$errors['qty_preorder.'+index]"></p>@enderror
                    </div>

                    <!-- Information (readonly) -->
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

                </div>
              </template>

                <div class="justify-end flex space-x-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-400 text-white rounded-md px-3.5 py-2.5 text-sm font-semibold shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                    Simpan Perubahan
                    </button>
                </div>
            </div>
          </form>

        </div>
      </main>

    </div>
  </div>
</body>
</html>
