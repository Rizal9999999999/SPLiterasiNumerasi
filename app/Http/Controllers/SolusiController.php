<?php

namespace App\Http\Controllers;

use App\Models\Solusi;
use Illuminate\Http\Request;

class SolusiController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Solusi';
        $data['rows'] = Solusi::orderBy('kode_solusi')->get();
        return view('solusi.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Solusi';
        $data['limit'] = 10;
        $data['rows'] = Solusi::where('nama_solusi', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_solusi')
            ->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('solusi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Solusi';
        return view('solusi.create', $data);
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
            'kode_solusi' => 'required|unique:tb_solusi',
            'nama_solusi' => 'required',
            'detail_solusi' => 'required',
            'min_nilai' => 'required',
            'max_nilai' => 'required',
            'warna' => 'required',
        ], [
            'kode_solusi.required' => 'Kode solusi harus diisi',
            'kode_solusi.unique' => 'Kode solusi harus unik',
            'nama_solusi.required' => 'Nama solusi harus diisi',
            'detail_solusi.required' => 'Detail solusi harus diisi',
            'min_nilai.required' => 'Min nilai harus diisi',
            'max_nilai.required' => 'Max nilai harus diisi',
            'warna.required' => 'Warna harus diisi',
        ]);
        $solusi = new Solusi($request->all());
        $solusi->save();

        return redirect('solusi')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solusi  $solusi
     * @return \Illuminate\Http\Response
     */
    public function show(Solusi $solusi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solusi  $solusi
     * @return \Illuminate\Http\Response
     */
    public function edit(Solusi $solusi)
    {
        $data['row'] = $solusi;
        $data['title'] = 'Ubah Solusi';
        return view('solusi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solusi  $solusi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solusi $solusi)
    {
        $request->validate([
            'nama_solusi' => 'required',
            'detail_solusi' => 'required',
            'min_nilai' => 'required',
            'max_nilai' => 'required',
            'warna' => 'required',
        ], [
            'nama_solusi.required' => 'Nama solusi harus diisi',
            'detail_solusi.required' => 'Detail solusi harus diisi',
            'min_nilai.required' => 'Min nilai harus diisi',
            'max_nilai.required' => 'Max nilai harus diisi',
            'warna.required' => 'Warna harus diisi',
        ]);
        $solusi->nama_solusi = $request->nama_solusi;
        $solusi->detail_solusi = $request->detail_solusi;
        $solusi->min_nilai = $request->min_nilai;
        $solusi->max_nilai = $request->max_nilai;
        $solusi->warna = $request->warna;
        $solusi->save();
        return redirect('solusi')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solusi  $solusi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solusi $solusi)
    {
        // query("DELETE FROM tb_relasi WHERE kode_solusi=?", [$solusi]);
        $solusi->delete();
        return redirect('solusi')->with('message', 'Data berhasil dihapus!');
    }
}
