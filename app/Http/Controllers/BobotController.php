<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BobotController extends Controller
{
    public function index()
    {
        $dataKriteria = Kriteria::all();
        $dataBobot = DB::table('bobots')
            ->join('kriterias', 'bobots.kriteria_id', '=', 'kriterias.id')
            ->select('bobots.bobot', 'bobots.id', 'kriterias.nama_kriteria', 'kriterias.id as kriteria_id') // Anda mungkin perlu menambahkan kolom kriteria_id untuk mengambil nilai ID kriteria
            ->get();

        return view('spk.step2', compact('dataBobot', 'dataKriteria'));
    }

    public function create()
    {
        return view('spk.create');
    }

    public function store(Request $request)
    {
        // Validasi input agar bobot tidak melebihi 1
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id', // Pastikan kriteria_id tersedia di tabel kriterias
            'bobot' => 'required|numeric|integer',
        ]);

        // Mengambil nilai kriteria_id dan bobot dari request
        $kriteriaId = $request->input('kriteria_id');
        $inputBobot = $request->input('bobot');

        // Menghitung nilai bobot sesuai logika yang diberikan
        // $nilaiBobot = ($inputBobot / 5); // Menggunakan pembagian nilai bobot dengan total yang telah ditentukan, yaitu 1

        // Membuat instance Bobot dengan nilai bobot dan kriteria_id yang sudah dihitung
        Bobot::create([
            'kriteria_id' => $kriteriaId,
            'bobot' => $inputBobot,
        ]);

        return redirect()->route('bobot.index')->with('success', 'Bobot created successfully.');
    }

    // public function show(Bobot $Bobot)
    // {
    //     return view('spk.show', compact('Bobot'));
    // }

    public function edit($id)
{
    $bobot = Bobot::findOrFail($id);

    // Pastikan hanya mengambil data yang sesuai dengan $id
    $dataBobot = DB::table('bobots')
        ->join('kriterias', 'bobots.kriteria_id', '=', 'kriterias.id')
        ->select('bobots.bobot', 'bobots.id', 'kriterias.nama_kriteria', 'kriterias.id as kriteria_id')
        ->where('bobots.id', $id)
        ->first();

    $dataKriteria = Kriteria::all();

    return view('spk.formEditBobot', compact('bobot', 'dataKriteria', 'dataBobot'));
}



public function update(Request $request, $id)
{
    $request->validate([
        'kriteria_id' => 'required|exists:kriterias,id',
        'bobot' => 'required|numeric|min:0|max:100',
    ]);

    $bobot = Bobot::findOrFail($id);

    $bobot->update([
        'kriteria_id' => $request->input('kriteria_id'),
        'bobot' => $request->input('bobot'),
    ]);

    return redirect()->route('bobot.index')->with('success', 'Bobot updated successfully.');
}

    public function destroy(Bobot $id)
    {
        // Find the Bobot instance by its ID
        $bobot = Bobot::findOrFail($id);

        // Delete the Bobot instance
        $bobot->delete();

        // Redirect to the kriteria index route with a success message
        return redirect()->route('kriteria.index')->with('success', 'Bobot deleted successfully');
    }
}
