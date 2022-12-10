<?php

namespace App\Http\Controllers;

use App\Models\Histori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriController extends Controller
{
    function detail(Request $request)
    {
        $id_histori = $request->query('id_histori');
        $histori = Histori::find($id_histori);
        $histori->detail = str_replace('btn btn-danger"', '" hidden', $histori->detail);
        $histori->detail = str_replace('<h1>Konsultasi</h1>', '<h1>Histori Detail</h1>', $histori->detail);
        $histori->detail = str_replace('Cetak</a>', 'Cetak</a> <a class="btn btn-danger" href="' . route('histori.index') . '"><i class="fa fa-backward"></i> Kembali</a>', $histori->detail);
        return $histori->detail;
    }

    public function cetak(Request $request)
    {
        $data['title'] = 'Laporan Data Histori';
        $data['q'] = $request->input('q');
        $query = Histori::join('tb_jenis', 'tb_jenis.kode_jenis', '=', 'tb_histori.kode_jenis')
            ->join('tb_solusi', 'tb_solusi.kode_solusi', '=', 'tb_histori.kode_solusi')
            ->join('tb_user', 'tb_user.id_user', '=', 'tb_histori.id_user')
            ->where(function ($query) use ($data) {
                $query->where('nama_user', 'like', '%' . $data['q'] . '%')
                    ->orWhere('nama_jenis', 'like', '%' . $data['q'] . '%');
            })
            ->orderByDesc('tb_histori.histori_created_at');

        if (is_user() || is_siswa())
            $query->where('tb_histori.id_user', Auth::id());

        $data['rows'] = $query->get();
        $data['no'] = 1;
        return view('histori.cetak', $data);
    }

    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Histori';
        $data['limit'] = 10;

        $query = Histori::join('tb_jenis', 'tb_jenis.kode_jenis', '=', 'tb_histori.kode_jenis')
            ->join('tb_solusi', 'tb_solusi.kode_solusi', '=', 'tb_histori.kode_solusi')
            ->join('tb_user', 'tb_user.id_user', '=', 'tb_histori.id_user')
            ->join('tb_siswa', 'tb_siswa.id_user', '=', 'tb_histori.id_user')
            ->where(function ($query) use ($data) {
                $query->where('nama_user', 'like', '%' . $data['q'] . '%')
                    ->orWhere('nisn', 'like', '%' . $data['q'] . '%')
                    ->orWhere('nama_jenis', 'like', '%' . $data['q'] . '%');
            })
            ->orderByDesc('tb_histori.histori_created_at');

        if (is_user() || is_siswa())
            $query->where('tb_histori.id_user', Auth::id());

        $data['rows'] = $query->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('histori.index', $data);
    }

    public function destroy(string $histori)
    {
        $histori = Histori::findOrFail($histori);
        $histori->delete();
        return redirect('histori')->with('message', 'Data berhasil dihapus!');
    }
}
