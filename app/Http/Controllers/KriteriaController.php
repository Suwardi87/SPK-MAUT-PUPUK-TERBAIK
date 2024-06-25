<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $dataKriteria = Kriteria::all();
        return view('spk.step1', compact('dataKriteria'));
    }

    public function create()
    {
        return view('spk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria created successfully.');
    }

    // public function show(Kriteria $kriteria)
    // {
    //     return view('spk.show', compact('kriteria'));
    // }

    // public function edit(Kriteria $kriteria)
    // {
    //     return view('spk.edit', compact('kriteria'));
    // }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'nama_kriteria' => 'required',
        ]);

        $kriteria->update($request->all());

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria updated successfully');
    }

    public function destroy(Kriteria $id)
    {
        $id->delete();

        return redirect()->route('kriteria.index')
            ->with('success', 'Kriteria deleted successfully');
    }
}
