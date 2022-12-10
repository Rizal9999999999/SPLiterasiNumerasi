@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
{{ show_error($errors) }}
<form method="POST" action="{{ route('hitung.indikator_action', ['kode_jenis' => $kode_jenis,'periode' => $periode]) }}">
    <input type="hidden" name="kode_jenis" value="{{ $kode_jenis }}" />
    <input type="hidden" name="periode" value="{{ $periode }}" />
    @csrf
    <div class="card card-primary card-outline">
        <div class="card-header">
            <strong>Pilih Indikator</strong>
        </div>
        <div class="card-body p-0 table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <th>Kode</th>
                    <th>Nama indikator</th>
                    <th>CF User</th>
                </thead>
                @foreach($indikators as $key => $indikator)
                <?php
                $rand = null;
                //matikan perintah ini agar pilihan menjadi kosong!
                //$rand = array_rand(['0' => '0', '0.4' => '0.4', '0.6' => '0.6', '0.8' => '0.8', '1' => '1']);
                ?>
                <tr>
                    <td>{{ $indikator->kode_indikator }}</td>
                    <td>{{ $indikator->nama_indikator }}</td>
                    <td>
                        <select class="form-control w-auto" name="cf_user[{{ $indikator->kode_indikator }}]">
                            <option value="">&nbsp; </option>
                            <?= get_cf_user_option(old('cf_user.' . $indikator->kode_indikator, $rand)) ?>
                        </select>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary"><i class="fa fa-signal"></i> Hitung</button>
            <a class="btn btn-danger" href="{{ route('hitung.index') }}"><i class="fa fa-backward"></i> Kembali</a>
        </div>
    </div>
</form>
@if(session('res'))
<?php
$res = session('res');
?>
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
    </div>
</div>
@endif
@endsection