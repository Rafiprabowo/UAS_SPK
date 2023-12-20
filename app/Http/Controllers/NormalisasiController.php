<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class NormalisasiController extends Controller
{
    public function index(){
        $decisionMatrix = \App\Models\DecisionMatrix::all();

        // Jika tidak ada data, kembalikan ke view dengan pesan
        if ($decisionMatrix->isEmpty()) {
            return view('normalisasi')->with('error', 'Tidak ada data Normalisasi yang tersimpan.');
        }

        // Buat array untuk menyimpan data yang akan ditampilkan di view
        $normalisasiTable = [];

        // Loop untuk menyusun data ke samping berdasarkan id_alternatif
        foreach ($decisionMatrix as $data) {
            $normalisasiTable[$data->alternatif_id][$data->kriteria_id] = $this->calculateNormalized($data->value, $data->kriteria_id);
        }

        // Ambil nama kriteria untuk header tabel
        $kriteriaNames = Kriteria::pluck('nama_kriteria', 'id')->toArray();

        // Kirim data ke view
        return view('normalisasi', compact('normalisasiTable', 'kriteriaNames'));
    }

    public function calculateNormalized($value, $idKriteria){
        $jenisKriteria = Kriteria::where('id', $idKriteria)->value('jenis_kriteria');
        $data = \App\Models\DecisionMatrix::where('kriteria_id', $idKriteria)->pluck('value')->toArray();

        $extremeValue = $jenisKriteria === 'benefit' ? max($data) : min($data);

        $normalizedValue = $jenisKriteria === 'benefit' ? $value / $extremeValue : $extremeValue / $value;

        $formattedValue = number_format($normalizedValue, 3);

        return $formattedValue;
    }
}
