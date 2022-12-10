@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('hitung.action') }}" method="POST">
    <div class="card">
        <div class="card-body">
            <p>Pada uji kompetensi literasi numerasi ini siswa menginputkan nilai atau seberapa keyakinan siswa
                terhadap kemampuan per indikator berdasarkan hasil ujian tertulis. </p>
            <table class="table table-bordered mb-3">
                <tbody>
                    <tr>
                        <td>Jenis Soal </td>
                        <td>Jumlah Indikator </td>
                        <td>Jumlah Soal </td>
                        <td>Pengisian Nilai </td>
                    </tr>
                    <tr>
                        <td>Pilihan Ganda </td>
                        <td>1 Indikator </td>
                        <td>4 Soal </td>
                        <td>
                            Benar 1 = Mungkin <br />
                            Benar 2 = Kemungkinan Bisa <br />
                            Benar 3 = Hampir Bisa <br />
                            Benar 4 = Bisa<br />
                            Salah Semua = Tidak Bisa
                        </td>
                    </tr>
                    <tr>
                        <td>Pilihan Ganda Komplek </td>
                        <td>1 Indikator </td>
                        <td>4 Soal </td>
                        <td>Benar 1 = Mungkin <br />
                            Benar 2 = Kemungkinan Bisa <br />
                            Benar 3 = Hampir Bisa <br />
                            Benar 4 = Bisa <br />
                            Salah Semua = Tidak Bisa </td>
                    </tr>
                    <tr>
                        <td>Menjodohkan </td>
                        <td>1 Indikator </td>
                        <td>1 Soal </td>
                        <td>Benar 1 = Mungkin<br />
                            Benar 2 = Kemungkinan Bisa <br />
                            Benar 3 = Hampir Bisa<br />
                            Benar 4 = Bisa <br />
                            Salah Semua = Tidak Bisa </td>
                    </tr>
                    <tr>
                        <td>Essay Singkat (Jawaban Pasti) </td>
                        <td>1 Indikator </td>
                        <td>1 Soal Bercabang </td>
                        <td>Benar 1 = Mungkin <br />
                            Benar 2 = Kemungkinan Bisa<br />
                            Benar 3 = Hampir Bisa <br />
                            Benar 4 = Bisa <br />
                            Salah Semua = Tidak Bisa </td>
                    </tr>
                    <tr>
                        <td rowspan="2">Non - Objektif (Essay atau Uraian) </td>
                        <td>1 Indikator </td>
                        <td>1 Soal Bercabang </td>
                        <td rowspan="2">Benar 1 = Mungkin <br />
                            Benar 2 = Kemungkinan Bisa<br />
                            Benar 3 = Hampir Bisa <br />
                            Benar 4 = Bisa <br />
                            Salah Semua = Tidak Bisa </td>
                    </tr>
                    <tr>
                        <td>1 Indikator </td>
                        <td>4 Soal </td>
                    </tr>
                </tbody>
            </table>

            <p>Untuk pengisian penilaian per indikator terdapat bobot nilai : </p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jenis Soal</th>
                        <th>Persentase Nilai</th>
                        <th>Nilai CF</th>
                    </tr>
                </thead>
                <tr>
                    <td>Pilihan Ganda</td>
                    <td>20%</td>
                    <td>0.5-0.6</td>
                </tr>
                <tr>
                    <td>Pilihan Ganda Kompleks</td>
                    <td>40%</td>
                    <td>0.9-1</td>
                </tr>
                <tr>
                    <td>Menjodohkan</td>
                    <td>10%</td>
                    <td>0.3-0.4</td>
                </tr>
                <tr>
                    <td>Essay Singkat (Jawaban Pasti)</td>
                    <td>5%</td>
                    <td>0.1-0.2</td>
                </tr>
                <tr>
                    <td>Non - Objektif(Essay atau Uraian)</td>
                    <td>25%</td>
                    <td>0.7-0.8</td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td>100%</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a class="btn btn-primary" href="{{ route('hitung.index') }}"><i class="fa fa-arrow-right"></i> Selanjutnya</a>
        </div>
    </div>
</form>
@endsection