<?php

namespace App\Http\Controllers;

use App\Models\Relasi;
use Illuminate\Http\Request;

class RelasiController extends Controller
{
    public function aturan()
    {
        $data['title'] = 'Laporan Data Relasi';
        $rows = Relasi::join('tb_kompetensi', 'tb_kompetensi.kode_kompetensi', '=', 'tb_relasi.kode_kompetensi')
            ->join('tb_indikator', 'tb_indikator.kode_indikator', '=', 'tb_relasi.kode_indikator')
            ->orderBy('tb_relasi.kode_kompetensi')
            ->orderBy('tb_relasi.kode_indikator')
            ->get();

        $data['aturan'] = array();
        foreach ($rows as $row) {
            $data['aturan'][$row->kode_kompetensi][$row->kode_indikator] = $row->kode_indikator;
        }
        $data['PENYAKIT'] = get_kompetensi();
        $data['GEJALA'] = get_indikator();
        return view('relasi.aturan', $data);
    }

    public function cetak()
    {
        $data['title'] = 'Laporan Data Relasi';
        $data['rows'] = Relasi::join('tb_kompetensi', 'tb_kompetensi.kode_kompetensi', '=', 'tb_relasi.kode_kompetensi')
            ->join('tb_indikator', 'tb_indikator.kode_indikator', '=', 'tb_relasi.kode_indikator')
            ->orderBy('tb_relasi.kode_kompetensi')
            ->orderBy('tb_relasi.kode_indikator')
            ->get();
        return view('relasi.cetak', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Relasi';
        $data['limit'] = 25;
        $data['rows'] = Relasi::where('nama_kompetensi', 'like', '%' . $data['q'] . '%')
            ->where('nama_indikator', 'like', '%' . $data['q'] . '%')
            ->join('tb_kompetensi', 'tb_kompetensi.kode_kompetensi', '=', 'tb_relasi.kode_kompetensi')
            ->join('tb_indikator', 'tb_indikator.kode_indikator', '=', 'tb_relasi.kode_indikator')
            ->orderBy('tb_relasi.kode_kompetensi')
            ->orderBy('tb_relasi.kode_indikator')
            ->paginate($data['limit']);
        return view('relasi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Relasi';
        return view('relasi.create', $data);
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
            'kode_kompetensi' => 'required',
            'kode_indikator' => 'required',
        ], [
            'kode_kompetensi.required' => 'Kompetensi harus diisi',
            'kode_indikator.required' => 'Indikator harus diisi',
        ]);
        $relasi = new Relasi($request->all());
        $relasi->save();
        return redirect('relasi')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function show(Relasi $relasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function edit(string $relasi)
    {
        $data['row'] = Relasi::findOrFail($relasi);
        $data['title'] = 'Ubah Relasi';
        return view('relasi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $relasi)
    {
        $request->validate([
            'kode_kompetensi' => 'required',
            'kode_indikator' => 'required',
        ], [
            'kode_kompetensi.required' => 'Kompetensi harus diisi',
            'kode_indikator.required' => 'Indikator harus diisi',
        ]);
        $relasi = Relasi::findOrFail($relasi);
        $relasi->kode_kompetensi = $request->kode_kompetensi;
        $relasi->kode_indikator = $request->kode_indikator;
        $relasi->save();
        return redirect('relasi')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relasi  $relasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $relasi)
    {
        $relasi = Relasi::findOrFail($relasi);
        $relasi->delete();
        return redirect('relasi')->with('message', 'Data berhasil dihapus!');
    }
}
