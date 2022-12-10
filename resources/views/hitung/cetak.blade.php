@extends('layout.print')
@section('title', $title)
@section('content')

<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Identitas</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <td>NISN</td>
                <td>{{ $user->nisn }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>{{ $user->nama_kelas }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>{{ $user->nama_siswa }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Indikator Terpilih</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Indikator</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $rows = get_results("SELECT * FROM tb_indikator");
            $cf_user = $res['cf_user'];
            foreach ($rows as $row) : ?>
                <?php if (isset($cf_user[$row->kode_indikator]) && $cf_user[$row->kode_indikator]) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_indikator ?></td>
                        <td><?= $cf_user[$row->kode_indikator] ?></td>
                    </tr>
                <?php endif ?>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Hasil Perhitungan</h3>
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
            <h4> Kategori {{ $res['solusi']['nama_solusi'] }}</h4>
            <p>{!! br_to_enter($res['solusi']['detail_solusi']) !!}</p>
        <?php endif ?>
    </div>
</div>
@endsection