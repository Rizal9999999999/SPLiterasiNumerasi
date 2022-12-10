<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Kompetensi';
        $data['rows'] =  Kompetensi::join('tb_jenis', 'tb_jenis.kode_jenis', '=', 'tb_kompetensi.kode_jenis')
            ->orderBy('tb_kompetensi.kode_jenis')
            ->orderBy('tb_kompetensi.kode_kompetensi')
            ->get();
        return view('kompetensi.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Kompetensi';
        $data['limit'] = 10;
        $data['rows'] = Kompetensi::where('nama_kompetensi', 'like', '%' . $data['q'] . '%')
            ->join('tb_jenis', 'tb_jenis.kode_jenis', '=', 'tb_kompetensi.kode_jenis')
            ->orderBy('tb_kompetensi.kode_jenis')
            ->orderBy('tb_kompetensi.kode_kompetensi')
            ->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('kompetensi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Kompetensi';
        return view('kompetensi.create', $data);
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
            'kode_kompetensi' => 'required|unique:tb_kompetensi',
            'kode_jenis' => 'required',
            'nama_kompetensi' => 'required',
        ], [
            'kode_kompetensi.required' => 'Kode kompetensi harus diisi',
            'kode_kompetensi.unique' => 'Kode kompetensi harus unik',
            'kode_jenis.required' => 'Kriteria harus diisi',
            'nama_kompetensi.required' => 'Nama kompetensi harus diisi',
        ]);
        $kompetensi = new Kompetensi($request->all());
        $kompetensi->save();
        return redirect('kompetensi')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function show(Kompetensi $kompetensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kompetensi $kompetensi)
    {
        $data['row'] = $kompetensi;
        $data['title'] = 'Ubah Kompetensi';
        return view('kompetensi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kompetensi $kompetensi)
    {
        $request->validate([
            'kode_jenis' => 'required',
            'nama_kompetensi' => 'required',
        ], [
            'kode_jenis.required' => 'Kriteria harus diisi',
            'nama_kompetensi.required' => 'Nama kompetensi harus diisi',
        ]);
        $kompetensi->kode_jenis = $request->kode_jenis;
        $kompetensi->nama_kompetensi = $request->nama_kompetensi;
        $kompetensi->save();
        return redirect('kompetensi')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kompetensi  $kompetensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kompetensi $kompetensi)
    {
        $kompetensi->delete();
        return redirect('kompetensi')->with('message', 'Data berhasil dihapus!');
    }
}
