<!-- Modal Body -->
@include('spk.header-spk')
<div class="container px-36 py-10">
    <div class="flex justify-between mb-1">
        <span class="text-base font-medium text-teal-700">2. Berikan bobot untuk setiap kriteria</span>
        <span class="text-sm font-medium text-teal-700">15%</span>
    </div>
    <div class="w-full bg-gray-200 rounded-full h-2.5">
        <div class="bg-teal-600 h-2.5 rounded-full" style="width: 15%"></div>
    </div>
    <form class="p-4 md:p-5" action="{{ route('bobot.update', $bobot->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid gap-4 mb-4">
            <label for="nama_kriteria_{{ $bobot->id }}" class="block mb-2 text-sm font-medium text-gray-900">Nama Kriteria</label>
            @if ($dataBobot)
                <input type="text" id="nama_kriteria_{{ $bobot->id }}" name="nama_kriteria" value="{{ $dataBobot->nama_kriteria }}"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5"
                       readonly>
                <!-- Menyembunyikan input untuk mengirim nilai kriteria_id -->
                <input type="hidden" name="kriteria_id" value="{{ $dataBobot->kriteria_id }}">
            @else
                <p class="text-red-500">Data kriteria tidak ditemukan.</p>
            @endif
        </div>

        <div class="grid gap-4 mb-4">
            <label for="bobot_{{ $bobot->id }}" class="block mb-2 text-sm font-medium text-gray-900">Bobot</label>
            <input type="number" name="bobot" id="bobot_{{ $bobot->id }}" value="{{ $bobot->bobot }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                   placeholder="Masukkan Bobot" required>
        </div>

        <button type="submit"
                class="text-white inline-flex items-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                      clip-rule="evenodd"></path>
            </svg>
            Simpan perubahan
        </button>
    </form>

