<x-app-layout>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container px-36 py-10">

                    <!-- Progress Bar -->
                    <div class="flex justify-between mb-1">
                        <span class="text-base font-medium text-teal-700">6. Hasil</span>
                        <span class="text-sm font-medium text-teal-700">100%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-teal-600 h-2.5 rounded-full" style="width: 100%"></div>
                    </div>

                    <!-- Tabel 1 Kriteria -->
                    <div class="relative my-10 overflow-x-auto">
                        <h2>Tabel Kriteria</h2>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama Kriteria</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($dataKriteria as $kriteria)
                                    <tr class="bg-white border-b">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $no++ }}
                                        </th>
                                        <td class="px-6 py-1">
                                            {{ $kriteria->nama_kriteria }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- ----------------------------close Table Kriteria---------------------------- -->


                    <!-- Tabel 2 Bobot Kriteria -->
                    <div class="relative my-10 overflow-x-auto">
                        <h2>Tabel Bobot Kriteria</h2>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nomor
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Kriteria
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nilai Bobot Kriteria
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bobotKriteria as $index => $bobot)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $bobot->nama_kriteria }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $bobot->bobot }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- ----------------------------close Table Bobot Kriteria---------------------------- -->

                    <!-- Tabel 3 Alternatif -->
                    <div class="relative my-10 overflow-x-auto">
                        <h2>Tabel Alternatif</h2>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Nama Supplier</th>
                                    <th scope="col" class="px-6 py-3">Kriteria</th>
                                    <th scope="col" class="px-6 py-3">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $groupedData = $alternatif->groupBy('nama_supplier');
                                @endphp
                                @foreach ($groupedData as $supplierName => $group)
                                    @php
                                        $rowspan = $group->count();
                                    @endphp
                                    @foreach ($group as $index => $supplier)
                                        <tr class="bg-white border-b">
                                            @if ($index === 0)
                                                <td rowspan="{{ $rowspan }}"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $loop->parent->iteration }}
                                                </td>
                                                <td rowspan="{{ $rowspan }}" class="px-6 py-4">
                                                    {{ $supplierName }}
                                                </td>
                                            @endif
                                            <td class="px-6 py-4">
                                                {{ $supplier->nama_kriteria }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $supplier->bobot }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- ----------------------------close Table Alternatif---------------------------- -->

                    <!-- Tabel 3 Normalisasi -->
                    <div class="relative my-10 overflow-x-auto">
                        <h2>Tabel Normalisasi</h2>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                              <tr>
                                <th scope="col" class="px-6 py-3">Nama Supplier</th>
                                @foreach ($dataKriteria as $kriteriaItem)
                                  <th scope="col" class="px-6 py-3">{{ $kriteriaItem->nama_kriteria }}</th>
                                @endforeach
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($groupedData as $supplierId => $data)
                                @php
                                  $supplierName = $data->first()->nama_supplier;
                                @endphp
                                <tr class="bg-white border-b">
                                  <td scope="row" class="text-center font-medium text-gray-900 whitespace-nowrap">
                                    {{ $supplierName }}
                                  </td>
                                  @foreach ($dataKriteria as $kriteriaItem)
                                    @php
                                      $bobotSupplier = $data->firstWhere('nama_kriteria', $kriteriaItem->nama_kriteria);
                                    @endphp
                                    <td class="px-6 py-4">
                                      @if ($bobotSupplier)
                                        {{ $bobotSupplier->bobot }}
                                      @else
                                        N/A
                                      @endif
                                    </td>
                                  @endforeach
                                </tr>
                              @endforeach
                            </tbody>
                          </table>

                    </div>
                    <!-- ----------------------------close Table Normalisasi---------------------------- -->

                    <!-- Tabel 4 Maximum dan Minimum -->
                    <div class="relative my-10 overflow-x-auto">
                        <h2>Tabel Maximum dan Minimum</h2>
                        <table class="w-full text-sm my-10 text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr class="text-center">
                                    <th>Nama Kriteria</th>
                                    <th>Bobot Minimum(+)</th>
                                    <th>Bobot Maksimum(-)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($showMinMaxBobot as $namaKriteria => $minMax)
                                <tr class="text-center bg-white border-b">
                                    <td>{{ $namaKriteria }}</td>
                                    <td>{{ isset($minMax['min']) ? $minMax['min'] : 'N/A' }}</td>
                                    <td>{{ isset($minMax['max']) ? $minMax['max'] : 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- ----------------------------close Table Maximum dan Minimum---------------------------- -->

                    <!-- Tabel 5 Skor Utilitas -->
                    <div class="relative my-10 overflow-x-auto">
                        <h2>Tabel Skor Utilitas</h2>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">Supplier</th>
                                    <th scope="col" class="px-6 py-3">Skor Utilitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                               @foreach($dataSupplier as $supplier)
                                    <tr>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $no++ }}
                                        </th>
                                        <td scope="col" class="px-6 py-3">{{ $supplier->nama_supplier }}</td>
                                        <td scope="col" class="px-6 py-3">{{ $bobotTernormalisasi[$supplier->id] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- ----------------------------close Table Skor Utilitas---------------------------- -->


                    <!-- Pagination -->
                    <div class="container px-4 py-10">
                        @include('spk.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


