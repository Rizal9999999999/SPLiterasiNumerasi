<?php

namespace App\Http\Controllers;

use App\Models\Indikator;
use App\Models\Histori;
use App\Models\Kompetensi;
use App\Models\Relasi;
use App\Models\Siswa;
use App\Models\Solusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HitungController extends Controller
{
    function pra()
    {
        $data['title'] = 'Konsultasi';
        return view('hitung.pra', $data);
    }
    function hasil(Request $request)
    {
        $data['title'] = 'Konsultasi';
        $data['kode_jenis'] = $request->query('kode_jenis');
        $data['periode'] = $request->query('periode');
        foreach (Kompetensi::all() as $kompetensi)
            $data['kompetensis'][$kompetensi->kode_kompetensi] =  $kompetensi;
        $data['indikators'] = Indikator::where('kode_jenis', $data['kode_jenis'])
            ->orderBy('kode_indikator')
            ->get();
        $data['solusis'] = Solusi::all();
        return view('hitung.indikator', $data);
    }
    function indikator(Request $request)
    {
        $data['title'] = 'Konsultasi';
        $data['kode_jenis'] = $request->query('kode_jenis');
        $data['periode'] = $request->query('periode');
        foreach (Kompetensi::all() as $kompetensi)
            $data['kompetensis'][$kompetensi->kode_kompetensi] =  $kompetensi;
        $data['indikators'] = Indikator::where('kode_jenis', $data['kode_jenis'])
            ->orderBy('kode_indikator')
            ->get();
        $data['solusis'] = Solusi::all();
        return view('hitung.indikator', $data);
    }

    function index(Request $request)
    {
        $data['title'] = 'Konsultasi';
        foreach (Kompetensi::all() as $kompetensi)
            $data['kompetensis'][$kompetensi->kode_kompetensi] =  $kompetensi;
        $data['indikators'] = Indikator::orderBy('kode_indikator')->get();
        return view('hitung.index', $data);
    }

    function action(Request $request)
    {
        $request->validate([
            'kode_jenis' => 'required',
            'periode' => 'required',
        ], [
            'kode_jenis.required' => 'Jenis harus diisi',
            'periode.required' => 'Periode harus diisi',
        ]);

        return redirect()->route('hitung.indikator', ['kode_jenis' => $request->kode_jenis, 'periode' => $request->periode]);
    }

    function indikator_action(Request $request)
    {
        $cf_user = $request->cf_user;
        foreach ($cf_user as $key => $val) {
            if ($val . '_' == '_')
                return back()->withInput()->withErrors([
                    'cf_user' => 'Isikan semua indikator!',
                ]);
        }
        $hasil = $this->hitung($cf_user);
        $rata = array_sum($hasil) / count($hasil) * 100;
        $solusi = '';
        foreach (Solusi::all() as $row) {
            if (round($rata) >= $row->min_nilai && round($rata) <= $row->max_nilai) {
                $solusi = $row;
            }
        }
        $res = array(
            'hasil' => $hasil,
            'rata' => $rata,
            'solusi' => $solusi,
            'cf_user' => $cf_user,
            'id_user' => Auth::id(),
        );

        $histori = new Histori([
            'id_user' => Auth::id(),
            'kode_jenis' => $request->kode_jenis,
            'periode' => $request->periode,
            'cf' => $rata,
            'kode_solusi' => '',
        ]);
        if ($solusi) {
            $histori->kode_solusi = $solusi->kode_solusi;
        }

        $data['res'] = $res;
        $data['title'] = 'Konsultasi';
        $data['kode_jenis'] = $request->query('kode_jenis');
        $data['periode'] = $request->query('periode');

        foreach (Kompetensi::all() as $kompetensi)
            $data['kompetensis'][$kompetensi->kode_kompetensi] =  $kompetensi;

        $histori->detail = view('hitung.hasil', $data);
        $histori->save();

        return view('hitung.hasil', $data);
    }

    function hitung($cf_user)
    {
        $rows = Relasi::join('tb_indikator', 'tb_indikator.kode_indikator', '=', 'tb_relasi.kode_indikator')->get();
        $relasi = array();
        foreach ($rows as $row) {
            if (
                isset($cf_user[$row->kode_indikator])
                // && $cf_user[$row->kode_indikator]
            )
                $relasi[$row->kode_kompetensi][$row->kode_indikator] = $row->nilai * $cf_user[$row->kode_indikator];
        }
        $hasil = [];
        foreach ($relasi as $key => $val) {
            $hasil[$key] = 0;
            foreach ($val as $k => $v) {
                $hasil[$key] = $hasil[$key] + (1 - $hasil[$key]) * $v;
            }
        }
        return $hasil;
    }

    function cetak(Request $request)
    {
        $data['title'] = 'Hasil Diagnosa';
        $data['res'] = $request->query('res');
        $data['user'] = Siswa::where('id_user', $data['res']['id_user'])
            ->leftJoin('tb_kelas', 'tb_kelas.kode_kelas', '=', 'tb_siswa.kode_kelas')
            ->first();

        foreach (Kompetensi::all() as $kompetensi)
            $data['kompetensis'][$kompetensi->kode_kompetensi] =  $kompetensi;
        return view('hitung.cetak', $data);
    }
}
