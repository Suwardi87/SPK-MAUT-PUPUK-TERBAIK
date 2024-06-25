
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SPK') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl py-3 sm:rounded-lg">
                <div class="container py-30 px-40">
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        1. <span class="font-medium">Mulai Dari Langkah Pertama!</span>
                      </div>
                    <div id="accordion-collapse" data-accordion="collapse">
                        <h6 id="accordion-collapse-heading-1">
                            <a href="kriteria"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
                                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                aria-controls="accordion-collapse-body-1">
                                <span>1. Identifikasi kriteria evaluasi </span>
                            </a>
                        </h6>
                        <h6 id="accordion-collapse-heading-2">
                            <a href="bobot"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
                                data-accordion-target="#accordion-collapse-body-2" aria-expanded="true"
                                aria-controls="accordion-collapse-body-2">
                                <span>2. Berikan bobot untuk setiap kriteria</span>
                            </a>
                        </h6>
                        <h6 id="accordion-collapse-heading-3">
                            <a href="supplier"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
                                data-accordion-target="#accordion-collapse-body-3" aria-expanded="true"
                                aria-controls="accordion-collapse-body-3">
                                <span>3. Kumpulkan data supplier</span>
                            </a>
                        </h6>
                        <h6 id="accordion-collapse-heading-4">
                            <a href="normalisasi"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
                                data-accordion-target="#accordion-collapse-body-4" aria-expanded="true"
                                aria-controls="accordion-collapse-body-4">
                                <span>4. Normalisasi data</span>
                            </a>
                        </h6>
                        <h6 id="accordion-collapse-heading-5">
                            <a href="skor-utilitas"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
                                data-accordion-target="#accordion-collapse-body-5" aria-expanded="true"
                                aria-controls="accordion-collapse-body-5">
                                <span>5. Hitung skor utilitas</span>
                            </a>
                        </h6>
                        {{-- <h6 id="accordion-collapse-heading-6">
                            <a href="supplier-terbaik"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
                                data-accordion-target="#accordion-collapse-body-6" aria-expanded="true"
                                aria-controls="accordion-collapse-body-6">
                                <span>6. Identifikasi Supplier Terbaik</span>
                            </a>
                        </h6> --}}
                        <h6 id="accordion-collapse-heading-7">
                            <a href="cetak-laporan"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
                                data-accordion-target="#accordion-collapse-body-7" aria-expanded="true"
                                aria-controls="accordion-collapse-body-7">
                                <span>6. Hasil</span>
                            </a>
                        </h6>
                        <h6 id="accordion-collapse-heading-7" class="text-end">
                            <a href="kriteria" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Mulai</a>
                        </h6>



                    </div>

            </div>
        </div>
    </div>
</x-app-layout>

