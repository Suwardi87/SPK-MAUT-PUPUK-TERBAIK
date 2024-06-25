<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\SupplierKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function index()
    {
        // Retrieve supplier data along with bobot and kriteria information
        $dataSupplier = DB::table('supplier_kriterias')->join('kriterias', 'supplier_kriterias.kriteria_id', '=', 'kriterias.id')->join('suppliers', 'supplier_kriterias.supplier_id', '=', 'suppliers.id')->select('suppliers.id as supplier_id', 'suppliers.nama_supplier', 'kriterias.nama_kriteria', 'supplier_kriterias.id', 'supplier_kriterias.kriteria_id', 'supplier_kriterias.bobot')->get();

        // Retrieve all bobots for normalization calculations
        $allBobots = Bobot::pluck('bobot')->toArray();
        $maxValue = max($allBobots);
        $minValue = min($allBobots);

        // Calculate SkorUtilitas for each supplier
        $supplierScores = [];
        foreach ($dataSupplier as $supplierData) {
            $supplierId = $supplierData->supplier_id;
            $bobot = $supplierData->bobot;

            // Normalize the bobot value using the formula
            $normalizedBobot = ($bobot - $minValue) / ($maxValue - $minValue);

            // Store the SkorUtilitas for each supplier
            if (!isset($supplierScores[$supplierId])) {
                $supplierScores[$supplierId] = 0;
            }
            $supplierScores[$supplierId] += $normalizedBobot;
        }

        // Attach the SkorUtilitas back to the supplier data
        foreach ($dataSupplier as $supplierData) {
            $supplierData->SkorUtilitas = $supplierScores[$supplierData->supplier_id];
        }

        // Sort the supplier data by SkorUtilitas
        $dataSupplier = $dataSupplier->sortByDesc('SkorUtilitas');

        // Retrieve kriteria and bobot data
        $dataKriteria = Kriteria::all();
        $dataBobot = Bobot::all();

        // Return the view with the data
        return view('spk.step3', compact('dataSupplier', 'dataKriteria', 'dataBobot'));
    }

    public function store(Request $request)
    {
        // Retrieve all kriteria
        $dataKriteria = Kriteria::all();

        // Initial validation for fixed fields
        $request->validate([
            'nama_supplier' => 'required|string',
        ]);

        // Dynamic validation for bobots_id fields
        foreach ($dataKriteria as $kriteria) {
            $request->validate([
                'bobots_id_' . $kriteria->id => 'required|numeric',
            ]);
        }

        // Create new supplier
        $supplier = new Supplier();
        $supplier->nama_supplier = $request->input('nama_supplier');
        $supplier->save();

        // Collect bobots for normalization
        $supplierBobots = [];

        foreach ($dataKriteria as $kriteria) {
            $supplierBobots[$kriteria->id] = $request->input('bobots_id_' . $kriteria->id);
        }

        // Initialize variables for skorUtilitas calculation
        // $bobotBaru = array_values($supplierBobots);
        $maxValue = max($supplierBobots);
        $minValue = min($supplierBobots);
        // Initialize variables for skorUtilitas calculation
        $skorUtilitas = [];

        // Calculate skorUtilitas based on all supplierBobots values
        foreach ($supplierBobots as $index => $bobot) {
            $skorUtilitas[$index] = ($bobot - $minValue) / ($maxValue - $minValue);
            // Normalize bobot value using skorUtilitas and store it
        }

        // Store SupplierKriteria data
        foreach ($dataKriteria as $kriteria) {
            // Retrieve bobot and skorUtilitas for this kriteria
            $bobot = $supplierBobots[$kriteria->id];
            $skor = $skorUtilitas[$kriteria->id];

            // Create and store SupplierKriteria
            SupplierKriteria::create([
                'supplier_id' => $supplier->id,
                'kriteria_id' => $kriteria->id,
                'bobot' => $bobot,
                'SkorUtilitas' => $skor,
            ]);
        }

        return redirect()->route('supplier.index')->with('success', 'Supplier added successfully!');
    }

    // public function SkorUtilitas()
    // {
    //     // Retrieve all suppliers with their related supplierKriterias
    //     $dataSupplier = Supplier::with('supplierKriterias.kriteria')->get();

    //     // Retrieve all criteria weights from the Bobot table
    //     $bobot = Bobot::all()->pluck('bobot', 'kriteria_id');

    //     // Normalize the bobot values
    //     $bobotNew = $bobot->map(function ($value) {
    //         return ($value * 1.0) / 10.0;
    //     });

    //     $bobotTernormalisasi = [];

    //     // Loop through suppliers to calculate bobotTernormalisasi for each supplier
    //     foreach ($dataSupplier as $supplier) {
    //         $totalBobotTernormalisasi = 0.0;

    //         foreach ($supplier->supplierKriterias as $kriteria) {
    //             $bobotForKriteria = (float) ($bobotNew[$kriteria->kriteria_id] ?? 0.0);
    //             $skorUtilitasKriteria = (float) ($kriteria->SkorUtilitas ?? 0.0);

    //             // Debugging output to check values
    //             // $debugInfo = [
    //             //     'supplier_id' => $supplier->id,
    //             //     'kriteria_id' => $kriteria->kriteria_id,
    //             //     'bobotForKriteria' => $bobotForKriteria,
    //             //     'skorUtilitasKriteria' => $skorUtilitasKriteria,
    //             //     'bobotNew' => $bobotNew[$kriteria->kriteria_id] ?? null,
    //             // ];

    //             // Print debugging information for each kriteria
    //             // echo "<pre>";
    //             // print_r($debugInfo);
    //             // echo "</pre>";

    //             // Calculate and add to total bobotTernormalisasi
    //             if (is_numeric($skorUtilitasKriteria)) {
    //                 $totalBobotTernormalisasi += $bobotForKriteria * $skorUtilitasKriteria;
    //             }
    //         }

    //         // Store total bobotTernormalisasi for this supplier
    //         $bobotTernormalisasi[$supplier->id] = $totalBobotTernormalisasi;
    //     }

    //     // Return the view with the data
    //     return view('spk.step5', compact('dataSupplier', 'bobotTernormalisasi'));
    // }


    public function SkorUtilitas()
    {
        // Retrieve all suppliers with their related supplierKriterias
        $dataSupplier = Supplier::with('supplierKriterias.kriteria')->get();

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

        // Return the view with the data
        return view('spk.step5', [
            'dataSupplier' => $sortedDataSupplier,
            'bobotTernormalisasi' => $bobotTernormalisasi
        ]);
    }



}
