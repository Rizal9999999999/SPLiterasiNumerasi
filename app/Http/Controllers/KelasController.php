<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Kelas';
        $data['rows'] = Kelas::orderBy('kode_kelas')->get();
        return view('kelas.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Kelas';
        $data['limit'] = 10;
        $data['rows'] = Kelas::where('nama_kelas', 'like', '%' . $data['q'] . '%')
            ->orderBy('kode_kelas')
            ->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('kelas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Kelas';
        return view('kelas.create', $data);
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
            'kode_kelas' => 'required|unique:tb_kelas',
            'nama_kelas' => 'required',
        ], [
            'kode_kelas.required' => 'Kode kelas harus diisi',
            'kode_kelas.unique' => 'Kode kelas harus unik',
            'nama_kelas.required' => 'Nama kelas harus diisi',
        ]);
        $kelas = new Kelas($request->all());
        $kelas->save();

        return redirect('kelas')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        $data['row'] = $kelas;
        $data['title'] = 'Ubah Kelas';
        return view('kelas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required',
        ], [
            'nama_kelas.required' => 'Nama kelas harus diisi',
        ]);
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->save();
        return redirect('kelas')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        // query("DELETE FROM tb_relasi WHERE kode_kelas=?", [$kelas]);
        $kelas->delete();
        return redirect('kelas')->with('message', 'Data berhasil dihapus!');
    }
}
