<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function show()
    {
        $data['title'] = 'Home';
        $data['indikator'] = get_var("SELECT COUNT(*) FROM tb_indikator");
        $data['kompetensi'] = get_var("SELECT COUNT(*) FROM tb_kompetensi");
        $data['siswa'] = get_var("SELECT COUNT(*) FROM tb_siswa");
        $data['solusi'] = get_var("SELECT COUNT(*) FROM tb_solusi");

        $rows = get_results("SELECT s.nama_solusi, COUNT(*) AS total FROM tb_histori h INNER JOIN tb_solusi s ON s.kode_solusi=h.kode_solusi GROUP BY s.nama_solusi");

        $data['data'] = array();
        $data['data2'] = array();
        $data['categories'] = array();
        foreach ($rows as $row) {
            $data['categories'][] = $row->nama_solusi;
            $data['data'][] = [
                'name' =>  $row->nama_solusi,
                'y' =>  $row->total * 1,
            ];
            $data['data2'][] = $row->total * 1;
        }

        $rows = get_results("SELECT j.nama_jenis, s.nama_solusi, COUNT(*) AS total FROM tb_histori h INNER JOIN tb_solusi s ON s.kode_solusi=h.kode_solusi INNER JOIN tb_jenis j ON j.kode_jenis=h.kode_jenis GROUP BY j.nama_jenis, s.nama_solusi");

        foreach ($rows as $row) {
            $data['charts'][$row->nama_jenis]['categories'][] = $row->nama_solusi;
            $data['charts'][$row->nama_jenis]['data'][] = [
                'name' =>  $row->nama_solusi,
                'y' =>  $row->total * 1,
            ];
            $data['charts'][$row->nama_jenis]['data2'][] = $row->total * 1;
        }
        // dd($data);
        return view('home', $data);
    }
}
