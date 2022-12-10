<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Jenis';
        $data['rows'] = Jenis::orderBy('kode_jenis')->get();
        return view('jenis.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Jenis';
        $data['limit'] = 10;
        $data['rows'] = Jenis::where('nama_jenis', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_jenis')
            ->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('jenis.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Jenis';
        return view('jenis.create', $data);
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
            'kode_jenis' => 'required|unique:tb_jenis',
            'nama_jenis' => 'required',
        ], [
            'kode_jenis.required' => 'Kode jenis harus diisi',
            'kode_jenis.unique' => 'Kode jenis harus unik',
            'nama_jenis.required' => 'Nama jenis harus diisi',
        ]);
        $jenis = new Jenis($request->all());
        $jenis->save();

        return redirect('jenis')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis $jenis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenis $jenis)
    {
        $data['row'] = $jenis;
        $data['title'] = 'Ubah Jenis';
        return view('jenis.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenis $jenis)
    {
        $request->validate([
            'nama_jenis' => 'required',
        ], [
            'nama_jenis.required' => 'Nama jenis harus diisi',
        ]);
        $jenis->nama_jenis = $request->nama_jenis;
        $jenis->save();
        return redirect('jenis')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis $jenis)
    {
        // query("DELETE FROM tb_relasi WHERE kode_jenis=?", [$jenis]);
        $jenis->delete();
        return redirect('jenis')->with('message', 'Data berhasil dihapus!');
    }
}
