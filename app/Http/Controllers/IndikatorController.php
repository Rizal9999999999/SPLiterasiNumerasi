<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Indikator';
        $data['rows'] =  Indikator::join('tb_jenis', 'tb_jenis.kode_jenis', '=', 'tb_indikator.kode_jenis')
            ->orderBy('tb_indikator.kode_jenis')
            ->orderBy('tb_indikator.kode_indikator')
            ->get();
        return view('indikator.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Indikator';
        $data['limit'] = 10;
        $data['rows'] = Indikator::where('nama_indikator', 'like', '%' . $data['q'] . '%')
            ->join('tb_jenis', 'tb_jenis.kode_jenis', '=', 'tb_indikator.kode_jenis')
            ->orderBy('tb_indikator.kode_jenis')
            ->orderBy('tb_indikator.kode_indikator')
            ->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('indikator.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Indikator';
        return view('indikator.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_indikator' => 'required|unique:tb_indikator',
            'kode_jenis' => 'required',
            'nama_indikator' => 'required',
            'nilai' => 'required',
        ], [
            'kode_indikator.required' => 'Kode indikator harus diisi',
            'kode_indikator.unique' => 'Kode indikator harus unik',
            'kode_jenis.required' => 'Kriteria harus diisi',
            'nama_indikator.required' => 'Nama indikator harus diisi',
            'nilai.required' => 'Nilai harus diisi',
        ]);
        $indikator = new Indikator($request->all());
        $indikator->save();
        return redirect('indikator')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function show(Indikator $indikator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function edit(Indikator $indikator)
    {
        $data['row'] = $indikator;
        $data['title'] = 'Ubah Indikator';
        return view('indikator.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indikator $indikator)
    {
        $request->validate([
            'kode_jenis' => 'required',
            'nama_indikator' => 'required',
            'nilai' => 'required',
        ], [
            'kode_jenis.required' => 'Kriteria harus diisi',
            'nama_indikator.required' => 'Nama indikator harus diisi',
            'nilai.required' => 'Nilai harus diisi',
        ]);
        $indikator->kode_jenis = $request->kode_jenis;
        $indikator->nama_indikator = $request->nama_indikator;
        $indikator->nilai = $request->nilai;
        $indikator->save();
        return redirect('indikator')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Indikator  $indikator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indikator $indikator)
    {
        $indikator->delete();
        return redirect('indikator')->with('message', 'Data berhasil dihapus!');
    }
}
