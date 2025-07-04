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
                pageName: 'Manajemen Pengiriman', 
                subPageName: 'Tambah Data Pengiriman'}">
              @include('Template.breadcrumb')
            </div>

            <div>
              <form method="POST" action="{{ route('shippings.store') }}">
              @csrf
              <div class="space-y-6">
                <div
                  class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                  <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3
                      class="text-base font-medium text-gray-800 dark:text-white/90">
                      Data pengiriman
                    </h3>
                  </div>
                  <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                      <!-- Create a grid layout for label and input -->
                      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Column 1 -->
                        <div class="flex items-center space-x-4">
                          <label for="sendTo" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Kepada <p class="text-red-500 inline">*</p></label>
                          <input
                            type="text"
                            id="sendTo"
                            name="sendTo"
                            value="{{ old('sendTo') }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                          />
                        </div>

                        <!-- Column 2 -->
                        <div class="flex items-center space-x-4">
                          <label for="numberSJN" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Nomor SJN <p class="text-red-500 inline">*</p></label>
                          <input
                            type="text"
                            id="numberSJN"
                            name="numberSJN"
                            value="{{ old('numberSJN') }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                          />
                        </div>

                        <!-- Column 3 -->
                        <div class="flex items-center space-x-4">
                          <label for="numberRef" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Nomor Ref <p class="text-red-500 inline">*</p></label>
                          <input
                            type="text"
                            id="numberRef"
                            name="numberRef"
                            value="{{ old('numberRef') }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                          />
                        </div>

                        <!-- Column 4 -->
                        <div class="flex items-center space-x-4">
                          <label for="projectName" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Proyek <p class="text-red-500 inline">*</p></label>
                          <input
                            type="text"
                            id="projectName"
                            name="projectName"
                            value="{{ old('projectName') }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                          />
                        </div>

                        <!-- Column 5 -->
                        <div class="flex items-center space-x-4">
                          <label for="poNumber" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Nomor PO <p class="text-red-500 inline">*</p></label>
                          <input
                            type="text"
                            id="poNumber"
                            name="poNumber"
                            value="{{ old('poNumber') }}"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                          />
                        </div>
                      </div>
                  </div>
                </div>
              </div>

              @php
                  $oldForms = [];
                  if (old('itemCode')) {
                      foreach (old('itemCode') as $index => $itemCode) {
                          $oldForms[] = [
                              'itemCode' => old("itemCode.$index"),
                              'itemName' => old("itemName.$index"),
                              'quantitySend' => old("quantitySend.$index"),
                              'unitType' => old("unitType.$index"),
                              'description' => old("description.$index"),
                              'totalSend' => old("totalSend.$index"),
                              'information' => old("information.$index"),
                              'qtyPreOrder' => old("qtyPreOrder.$index"),
                          ];
                      }
                  }
              @endphp
              
              <div class="space-y-6">
                <div
                  x-data="{
                    totalBarang: {{ count($oldForms) > 0 ? count($oldForms) : 1 }},
                    forms: {{ json_encode(count($oldForms) > 0 ? $oldForms : [['itemName'=>'', 'itemCode'=>'', 'quantitySend'=>'', 'unitType'=>'', 'description'=>'', 'totalSend'=>'', 'information'=>'', 'qtyPreOrder'=>'']]) }}
                  }"
                  class="py-4"
                >
                  <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5 flex flex-inline justify-between">
                      <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                        Data barang pengiriman
                      </h3>
                      <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                        Total barang: <span x-text="totalBarang"></span>
                      </h3>
                    </div>
                  
                    <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                        <template x-for="(form, index) in forms" x-bind:key="index">
                          <div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pb-6">
                              <!-- Column 0 -->
                              <div class="flex items-center space-x-4">
                                <label for="itemName" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Nama barang <p class="text-red-500 inline">*</p></label>
                                <input
                                  type="text"
                                  x-model="form.itemName"
                                  id="itemName"
                                  name="itemName[]"
                                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                />
                              </div>

                              <!-- Column 1 -->
                              <div class="flex items-center space-x-4">
                                <label for="itemCode" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Kode barang <p class="text-red-500 inline">*</p></label>
                                <input
                                  type="text"
                                  x-model="form.itemCode"
                                  id="itemCode"
                                  name="itemCode[]"
                                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                />
                              </div>

                              <!-- Column 3 -->
                              <div class="flex items-center space-x-4">
                                <label for="unitType" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Satuan <p class="text-red-500 inline">*</p></label>
                                <select
                                  x-model="form.unitType"
                                  name="unitType[]"
                                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
                                >
                                  <option value="">--pilih satuan--</option>
                                  @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                  @endforeach
                                </select>
                              </div>


                              <!-- Column 2 -->
                              <div class="flex items-center space-x-4">
                                <label for="quantitySend" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Qty Kirim <p class="text-red-500 inline">*</p></label>
                                <input
                                  type="number"
                                  x-model="form.quantitySend"
                                  id="quantitySend"
                                  name="quantitySend[]"
                                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                />
                              </div>

                                <!-- Colum 7 -->
                                <div class="flex items-center space-x-4">
                                <label for="qtyPreOrder" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Qty PO <p class="text-red-500 inline">*</p></label>
                                <input
                                  type="number"
                                  x-model="form.qtyPreOrder"
                                  id="qtyPreOrder"
                                  name="qtyPreOrder[]"
                                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                />
                              </div>

                              <!-- Column 5 -->
                              <div class="flex items-center space-x-4">
                                <label for="totalSend" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Total Kirim <p class="text-red-500 inline">*</p></label>
                                <input
                                  type="number"
                                  x-model="form.totalSend"
                                  id="totalSend"
                                  name="totalSend[]"
                                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                />
                              </div>

                              <!-- Column 4 -->
                              <div class="flex items-start space-x-4">
                                <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Deskripsi <p class="text-red-500 inline">*</p></label>
                                <input
                                  type="text"
                                  x-model="form.description"
                                  id="description"
                                  name="description[]"
                                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-full w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                />
                              </div>

                              <!-- Column 6 -->
                              <div class="flex items-start space-x-4">
                                <label for="information" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400 w-1/3">Keterangan </label>
                                <input
                                  type="text"
                                  x-model="form.information"
                                  id="information"
                                  name="information[]"
                                  class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-full w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                />
                              </div>
                              
                              <div class="flex justify-end space-x-4">
                                <button type="button" @click="forms.splice(index, 1); totalBarang--"
                                  :class="forms.length <= 1 ? 'bg-gray-400 cursor-not-allowed' : 'bg-red-500 hover:bg-red-400'"
                                  :disabled="forms.length <= 1"
                                  class="rounded-md text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                                  Hapus Item
                                </button>
                              </div>
                            </div>
                            <hr class="border-t border-gray-300 dark:border-gray-800 mt-2" />
                            
                          </div>
                          
                        </template>

                        <div class="justify-end flex space-x-4">
                          <button type="button" @click="if (forms.length < 10) { forms.push({ itemName:'', itemCode: '', quantitySend: '', unitType: '', description: '', totalSend: '', information: '', qtyPreOrder:'' }); totalBarang++ }" :class="forms.length >= 10 ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-500 hover:bg-blue-400'" :disabled="forms.length >= 10" class="rounded-md text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            Tambah Item
                          </button>
                          
                          <button type="submit" :class="forms.length === 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-green-500 hover:bg-green-400'" :disabled="forms.length === 0" class="rounded-md text-white px-3.5 py-2.5 text-sm font-semibold shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            Submit
                          </button>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>

        </main>
        <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </body>
</html>
