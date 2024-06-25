<x-app-layout>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container px-36 py-10">
                    <div class="flex justify-between mb-1">
                        <span class="text-base font-medium text-teal-700">5. Hitung skor utilitas</span>
                        <span class="text-sm font-medium text-teal-700">70%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-teal-600 h-2.5 rounded-full" style="width: 70%"></div>

                    </div>



                    <div class="relative my-10 overflow-x-auto">
                        <!-- Tabel Skor Utilitas -->

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



                    <div class="container px-4 py-10">
                        @include('spk.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


