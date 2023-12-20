<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kriteria = Kriteria::all();
        return view('kriteria.index', compact('kriteria'    ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_kriteria' => 'required',
            'jenis_kriteria' => 'required',
            'bobot' => 'required'
        ]);
        $kriteria = new Kriteria();
        $kriteria->nama_kriteria = $request->get('nama_kriteria');
        $kriteria->jenis_kriteria = $request->get('jenis_kriteria');
        $kriteria->bobot = $request->get('bobot');

        $kriteria->save();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kriteria' => 'required',
            'jenis_kriteria' => 'required',
            'bobot' => 'required'
        ]);

        $kriteria = Kriteria::where('id', $id)->first();
        $kriteria->nama_kriteria = $request->get('nama_kriteria');
        $kriteria->jenis_kriteria = $request->get('jenis_kriteria');
        $kriteria->bobot = $request->get('bobot');

        $kriteria->save();
        return redirect()->route('kriteria.index')
            -> with('success', 'Data Kriteria Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kriteria::find($id)->delete();
        return redirect()->route('kriteria.index') -> with('success', 'Data Kriteria Berhasil Dihapus');
    }
}
