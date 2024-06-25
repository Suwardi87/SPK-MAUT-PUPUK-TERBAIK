<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\SupplierKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpkController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('spk.main', compact('kriteria'));
    }

    public function bobot()
    {
        $dataBobot = Bobot::join('kriterias', 'kriterias.id', '=', 'bobots.kriteria_id')->select('bobots.*', 'kriterias.nama_kriteria', 'bobots.bobot')->get();

        return view('spk.step2', compact('dataBobot'));
    }

    public function nilaiKriteria()
    {
        $dataSupplier = Supplier::all();
        return view('spk.step3', compact('dataSupplier'));
    }

    // Calculate the minimum and maximum bobot values for a supplier
    private function showMinMaxBobot($supplierId)
    {
        $bobots = SupplierKriteria::where('supplier_id', $supplierId)->pluck('bobot')->toArray();
        return [
            'max' => max($bobots),
            'min' => min($bobots),
        ];
    }

    public function normalisasi(Request $request)
    {
        $dataKriteria = Kriteria::all();
        $supplierData = DB::table('supplier_kriterias')->join('kriterias', 'supplier_kriterias.kriteria_id', '=', 'kriterias.id')->join('suppliers', 'supplier_kriterias.supplier_id', '=', 'suppliers.id')->select('suppliers.id as supplier_id', 'suppliers.nama_supplier', 'supplier_kriterias.bobot', 'kriterias.nama_kriteria', 'supplier_kriterias.id')->get();

        // Group data by supplier ID
        $groupedData = $supplierData->groupBy('supplier_id');

        // Initialize array to store min-max data
        $showMinMaxBobot = [];

        // Iterate through each supplier
        foreach ($groupedData as $supplierId => $data) {
            // Call method showMinMaxBobot() to get min-max data for the supplier
            $showMinMaxBobot[$supplierId] = $this->showMinMaxBobot($supplierId);
        }

        return view('spk.step4', compact('supplierData', 'dataKriteria', 'groupedData', 'showMinMaxBobot', 'request'));
    }

    public function cetakLaporan()
    {
        // Table Data Kriteria
        $dataKriteria = Kriteria::all();
        $dataBobot = Bobot::all();
        // ---------------------close Data Kriteria----------------------

        // Table Data Bobot Kriteria
        $bobotKriteria = DB::table('bobots')
            ->join('kriterias', 'bobots.kriteria_id', '=', 'kriterias.id')
            ->select('bobots.bobot', 'kriterias.nama_kriteria', 'kriterias.id as kriteria_id') // Anda mungkin perlu menambahkan kolom kriteria_id untuk mengambil nilai ID kriteria
            ->get();

        // ---------------------close Bobot Kriteria----------------------

        // Table Data Alternatif
        // Retrieve supplier data along with bobot and kriteria information
        $alternatif = DB::table('supplier_kriterias')
         ->join('kriterias', 'supplier_kriterias.kriteria_id', '=', 'kriterias.id')
         ->join('suppliers', 'supplier_kriterias.supplier_id', '=', 'suppliers.id')
         ->select('suppliers.id as supplier_id', 'suppliers.nama_supplier', 'kriterias.nama_kriteria', 'supplier_kriterias.id', 'supplier_kriterias.kriteria_id', 'supplier_kriterias.bobot')
         ->get();
        // ---------------------close Alternatif----------------------

        // Table Data normalisasi
        $normalisasi = DB::table('supplier_kriterias')
        ->join('kriterias', 'supplier_kriterias.kriteria_id', '=', 'kriterias.id')
            ->join('suppliers', 'supplier_kriterias.supplier_id', '=', 'suppliers.id')
            ->select('suppliers.id as supplier_id', 'suppliers.nama_supplier', 'supplier_kriterias.bobot', 'kriterias.nama_kriteria', 'supplier_kriterias.id')
            ->get();
        // Group data by supplier ID
        $groupedDataNormalisasi = $normalisasi->groupBy('supplier_id');

        // Initialize array to store min-max data
        $showMinMaxBobot = [];

        // Iterate through each supplier
        foreach ($groupedDataNormalisasi as $supplierId => $data) {
            // Call method showMinMaxBobot() to get min-max data for the supplier
            $showMinMaxBobot[$supplierId] = $this->showMinMaxBobot($supplierId);
        }
        // ---------------------close normalisasi----------------------

        // Table Data Skor Utilitas
        $dataSupplier = Supplier::all();
         // Retrieve all criteria weights from the Bobot table
    $bobot = Bobot::all()->pluck('bobot', 'kriteria_id');

    // Normalize the bobot values
    $bobotNew = $bobot->map(function ($value) {
        return ($value * 1.0) / 10.0;
    });

    $bobotTernormalisasi = [];

    // Loop through suppliers to calculate bobotTernormalisasi for each supplier
    foreach ($dataSupplier as $supplier) {
        $totalBobotTernormalisasi = 0.0;

        foreach ($supplier->supplierKriterias as $kriteria) {
            $bobotForKriteria = (float) ($bobotNew[$kriteria->kriteria_id] ?? 0.0);
            $skorUtilitasKriteria = (float) ($kriteria->SkorUtilitas ?? 0.0);

            // Calculate and add to total bobotTernormalisasi
            if (is_numeric($skorUtilitasKriteria)) {
                $totalBobotTernormalisasi += $bobotForKriteria * $skorUtilitasKriteria;
            }
        }

        // Store total bobotTernormalisasi for this supplier
        $bobotTernormalisasi[$supplier->id] = $totalBobotTernormalisasi;
    }

    // Sort the bobotTernormalisasi array in descending order
    arsort($bobotTernormalisasi);

    // Sort dataSupplier based on sorted bobotTernormalisasi
    $sortedDataSupplier = $dataSupplier->sortByDesc(function ($supplier) use ($bobotTernormalisasi) {
        return $bobotTernormalisasi[$supplier->id];
    })->values();

        // ---------------------close Skor Utilitas----------------------

        return view('spk.step7', compact('dataKriteria','bobotKriteria','dataBobot','alternatif','normalisasi','groupedDataNormalisasi','showMinMaxBobot','bobotTernormalisasi'),[
            'dataSupplier' => $sortedDataSupplier,
            'bobotTernormalisasi' => $bobotTernormalisasi
        ]);

    }

    public function supplierTerbaik()
    {
        return view('spk.step6');
    }
}
