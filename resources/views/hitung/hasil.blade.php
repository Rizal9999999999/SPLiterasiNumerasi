@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
{{ show_error($errors) }}

<div class="card">
    <div class="card-header">
        <strong>Hasil Perhitungan</strong>
    </div>
    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                <th>CF</th>
            </thead>
            @foreach($res['hasil'] as $key => $val)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $kompetensis[$key]->nama_kompetensi }}</td>
                <td>{{ round($val * 100, 2) }} % </td>
            </tr>
            @endforeach
            <tfoot>
                <tr>
                    <td colspan="2">Rata-rata</td>
                    <td><?= round($res['rata'], 2) ?>%</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer">
        <?php if ($res['solusi']) : ?>
            <h4>{{ $res['solusi']->nama_solusi }}</h4>
            <p>{!! br_to_enter($res['solusi']->detail_solusi) !!}</p>

        <?php
            $res['solusi'] = [
                'nama_solusi' => $res['solusi']->nama_solusi,
                'detail_solusi' => $res['solusi']->detail_solusi,
            ];
        endif ?>
        <a class="btn btn-default" href="{{ route('hitung.cetak', ['res' => $res, 'cf_user' => session('cf_user')]) }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
        <a class="btn btn-danger" href="{{ route('hitung.pra', ['kode_jenis' => $kode_jenis, 'periode' => $periode]) }}"><i class="fa fa-backward"></i> Kembali</a>
    </div>
</div>
@endsection