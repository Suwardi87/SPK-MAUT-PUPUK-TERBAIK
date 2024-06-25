<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container px-36 py-10">
                    <div class="flex justify-between mb-1">
                        <span class="text-base font-medium text-teal-700">2. Berikan bobot untuk setiap kriteria</span>
                        <span class="text-sm font-medium text-teal-700">15%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-teal-600 h-2.5 rounded-full" style="width: 15%"></div>
                    </div>

                    <div class="relative my-10 overflow-x-auto">

                        <!-- tambah -->
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="block text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            type="button">
                            Tambah
                        </button>
                        <div class="flex p-4 my-4 text-sm text-teal-800 rounded-lg bg-teal-50 dark:bg-gray-800 dark:text-teal-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Aturan Bobot Setiap Kriteria:</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    <li>Berikan bobot setiap kriteria yang ada dari angka [1, 2, 3, 4, 5].</li>
                                    <li>Tambahkan bobot setiap kriteria jika kriteria belum memiliki bobot.</li>
                                </ul>
                            </div>
                        </div>


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
                                    <th scope="col" class="px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataBobot as $index => $bobot)
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
                                        <td class="px-6 py-4">
                                            <!-- Form untuk Edit -->

                                            <a href="{{ route('bobot.edit', $bobot->id) }}" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded">
                                                Edit
                                            </a>




                                        </td>
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




<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Berikan bobot
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('bobot.store') }}" method="POST">
                @csrf <!-- Tambahkan csrf token untuk keamanan -->
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <label for="kriteria_id" class="block mb-2 text-sm font-medium text-gray-900">Nama Kriteria</label>
                    <select id="kriteria_id" name="kriteria_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5">
                        @foreach ($dataKriteria as $kriteria)
                            <option value="{{ $kriteria->id }}">{{ $kriteria->nama_kriteria }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <label for="bobot" class="block mb-2 text-sm font-medium text-gray-900">Bobot</label>
                    <input type="number" name="bobot" id="bobot"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Masukkan Bobot" required>
                </div>

                <button type="submit"
                    class="text-white inline-flex items-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah bobot kriteria
                </button>
            </form>


        </div>
    </div>
</div>
