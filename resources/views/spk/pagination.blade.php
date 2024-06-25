<nav aria-label="Page navigation example">
    <ul class="inline-flex -space-x-px text-sm">
        <li>
            <a href="/spk/kriteria"
                class="block py-2 px-3 md:p-2 rounded-l-lg border
                @if (request()->is('spk/alternatif')) text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                Previous
            </a>
        </li>
        <li>
            <a href="/spk/kriteria"
                class="block py-2 px-3 md:p-2 rounded-lg border
                @if (request()->is('spk/alternatif')) text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                1
            </a>
        </li>
        <li>
            <a href="/spk/bobot"
                class="block py-2 px-3 md:p-2 rounded-lg border
                @if (request()->is('spk/bobot')) text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                2
            </a>
        </li>
        <li>
            <a href="/spk/supplier"
                class="block py-2 px-3 md:p-2 rounded-lg border
                @if (request()->is('spk/supplier')) text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                3
            </a>
        </li>
        <li>
            <a href="/spk/normalisasi"
                class="block py-2 px-3 md:p-2 rounded-lg border
                @if (request()->is('spk/normalisasi')) text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                4
            </a>
        </li>
        <li>
            <a href="/spk/skor-utilitas"
                class="block py-2 px-3 md:p-2 rounded-lg border
                @if (request()->is('spk/skorUtilitas')) text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                5
            </a>
        </li>
        {{-- <li>
            <a href="/spk/supplier-terbaik"
                class="block py-2 px-3 md:p-2 rounded-lg border
                @if (request()->is('spk/supplier-terbaik')) text-white bg-blue-700 md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                6
            </a>
        </li> --}}
        <li>
            <a href="/spk/cetak-laporan"
                class="block py-2 px-3 md:p-2 rounded-lg border
                @if (request()->is('spk/cetak-laporan')) text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                6
            </a>
        </li>
        <li>
            <a href="/spk/cetak-laporan"
                class="block py-2 px-3 md:p-2 rounded-r-lg border
                @if (request()->is('spk/cetak-laporan')) text-white bg-blue-700  md:bg-transparent md:text-blue-700 md:dark:text-blue-500
                @else
                hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 md:dark:hover:bg-transparent
                @endif">
                Next
            </a>
        </li>

    </ul>
</nav>
