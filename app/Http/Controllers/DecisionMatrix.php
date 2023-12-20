<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DecisionMatrix extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data DecisionMatrix dari database
        $decision_matrix = \App\Models\DecisionMatrix::all();

        // Jika tidak ada data, kembalikan ke view dengan pesan
        if ($decision_matrix->isEmpty()) {
            return view('decisionMatrix.index')->with('error', 'Tidak ada data Decision Matrix yang tersimpan.');
        }

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $matrixTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($decision_matrix as $data) {
            $matrixTable[$data->alternatif_id][$data->kriteria_id] = $data->value;
        }

        // Ambil nama kriteria untuk header tabel
        $kriteriaNames = DB::table('kriterias')->pluck('nama_kriteria', 'id')->toArray();

        // Kirim data ke view
        return view('decisionMatrix.index', compact('matrixTable', 'kriteriaNames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();

        if ($alternatif->isEmpty()) {
            return redirect()->route('/dashbaord')->with('error', 'Tidak ada alternatif yang ditemukan.');
        }

        return view('decisionMatrix.create', compact('alternatif', 'kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'value_*_*' => 'required|numeric',
        ]);

        try {
            $alt = Alternatif::all();
            $krit = Kriteria::all();

            foreach ($alt as $Alt) {
                if (!$Alt->isUsed()) {
                    foreach ($krit as $Krit) {
                        $fieldName = 'value_' . $Alt->id . '_' . $Krit->id;
                        $dec = new \App\Models\DecisionMatrix();
                        $dec->alternatif_id = $Alt->id;
                        $dec->kriteria_id = $Krit->id;
                        $dec->value = $request->get($fieldName);
                        $dec->save();
                    }
                }
            }

            return redirect()->route('decision-matrix.index')->with('success', 'Nilai Decision Matrix berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('decision-matrix.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $matrixData = \App\Models\DecisionMatrix::where('alternatif_id', $id)->get();

        // Jika tidak ada data, kembalikan ke view dengan pesan
        if ($matrixData->isEmpty()) {
            return redirect()->route('decision-matrix.index')->with('error', 'Tidak ada data Decision Matrix untuk alternatif ini.');
        }

        // Ambil alternatif dan kriteria
        $alternatif = Alternatif::findOrFail($id);
        $kriteria = Kriteria::all();

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $matrixTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($matrixData as $data) {
            $matrixTable[$data->kriteria_id] = $data->value;
        }

        return view('decisionMatrix.edit', compact('alternatif', 'kriteria', 'matrixTable'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'value.*' => 'required|numeric', // Validasi untuk setiap nilai
        ]);

        try {
            foreach ($request->value as $kriteria_id => $value) {
                \App\Models\DecisionMatrix::where('alternatif_id', $id)
                    ->where('kriteria_id', $kriteria_id)
                    ->update(['value' => $value]);
            }
            return redirect()->route('decision-matrix.index')->with('success', 'Nilai Decision Matrix berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('decision-matrix.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            \App\Models\DecisionMatrix::where('alternatif_id', $id)->delete();
            return redirect()->route('decision-matrix.index')->with('success', 'Data Decision Matrix berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('decision-matrix.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
