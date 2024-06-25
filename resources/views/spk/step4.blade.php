<x-app-layout>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container px-36 py-10">
                    <div class="flex justify-between mb-1">
                        <span class="text-base font-medium text-teal-700">4. Normalisasi data</span>
                        <span class="text-sm font-medium text-teal-700">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-teal-600 h-2.5 rounded-full" style="width: 45%"></div>
                    </div>
                    <div class="overflow-x-auto">
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
                                        <td scope="row"
                                            class="text-center font-medium text-gray-900 whitespace-nowrap">
                                            {{ $supplierName }}
                                        </td>
                                        @foreach ($dataKriteria as $kriteriaItem)
                                            @php
                                                $bobotSupplier = $data->firstWhere(
                                                    'nama_kriteria',
                                                    $kriteriaItem->nama_kriteria,
                                                );
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

                        <!-- Table to display min-max bobot -->
                        <table class="w-full text-sm my-20 text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr class="text-center">
                                    <th>Nama Kriteria</th>
                                    <th>Bobot Minimum(+)</th>
                                    <th>Bobot Maksimum(-)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($showMinMaxBobot as $namaKriteria => $minMax)
                                    <tr class="text-center bg-white border-b">
                                        <td>{{ $namaKriteria }}</td>
                                        <td>{{ isset($minMax['min']) ? $minMax['min'] : 'N/A' }}</td>
                                        <td>{{ isset($minMax['max']) ? $minMax['max'] : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="container px-4 py-10">
                            @include('spk.pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
