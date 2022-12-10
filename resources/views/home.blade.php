@extends('layout.app')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $indikator }}</h3>
                <p>Indikator</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('indikator.index') }}" class="small-box-footer" {{ is_hidden('indikator.index') }}>More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $kompetensi }}</h3>
                <p>Kompetensi</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('kompetensi.index') }}" class="small-box-footer" {{ is_hidden('kompetensi.index') }}>More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $siswa }}</h3>
                <p>Siswa</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('siswa.index') }}" class="small-box-footer" {{ is_hidden('siswa.index') }}>More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $solusi }}</h3>
                <p>Solusi</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="{{ route('solusi.index') }}" class="small-box-footer" {{ is_hidden('solusi.index') }}>More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<p>       Pendidikan menjadi kunci dalam pembentukan kemampuan manusia untuk menyerap teknologi terbarukan, serta untuk mengembangkan kapasitas diri supaya tercipta pertumbuhan serta pembangunan yang berkelanjutan. Pendidikan dapat digunakan untuk menggapai kehidupan yang memuaskan dan berharga. Dengan pendidikan akan terbentuk kapabilitas manusia yang lebih luas yang berada pada inti makna pembangunan. 
Sangat pentingnya Pendidikan salah satunya adalah kemampuan literasi dan numerasi pada anak sekolah dasar dimana yang menjadi kompetensi yang sifatnya sangat dasar. Literasi dan Numerasi menjadi kompetensi yang dibutuhkan para siswa sekolah dasar untuk bisa mengikuti proses belajar.
Untuk mengetahui kemampuan Literasi dan Numerasi di Sekolah dasar Islam Wali Songo Trowulan maka dilakukan pembuatan sistem pakar dengan metode algoritma certainty factor.
</p>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div class="card">
    <div class="card-header">
        Grafik Semua Jenis
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="container2"></div>
                </figure>
            </div>
        </div>
    </div>
    <script>
        // Data retrieved from https://netmarketshare.com
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Persentase Hasil Perhitungan'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Hasil Konsultasi',
                colorByPoint: true,
                data: <?= json_encode($data) ?>
            }]
        });
    </script>
    <script>
        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Hasil Perhitungan'
            },
            xAxis: {
                categories: <?= json_encode($categories) ?>,
                crosshair: true
            },
            yAxis: {
                title: {
                    useHTML: true,
                    text: 'Jumlah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Total',
                data: <?= json_encode($data2) ?>
            }]
        });
    </script>
</div>

<?php
$no = 1;
?>
@foreach($charts as $nama_jenis => $chart)

<div class="card">
    <div class="card-header">
        Grafik {{ $nama_jenis }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="container_{{ $no }}"></div>
                </figure>
            </div>
            <div class="col">
                <figure class="highcharts-figure">
                    <div id="container2_{{ $no }}"></div>
                </figure>
            </div>
        </div>
    </div>
    <script>
        // Data retrieved from https://netmarketshare.com
        Highcharts.chart('container_{{ $no }}', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Persentase Hasil Perhitungan'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Hasil Konsultasi',
                colorByPoint: true,
                data: <?= json_encode($chart['data']) ?>
            }]
        });
    </script>
    <script>
        Highcharts.chart('container2_{{ $no }}', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Jumlah Hasil Perhitungan'
            },
            xAxis: {
                categories: <?= json_encode($chart['categories']) ?>,
                crosshair: true
            },
            yAxis: {
                title: {
                    useHTML: true,
                    text: 'Jumlah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Total',
                data: <?= json_encode($chart['data2']) ?>
            }]
        });
    </script>
</div>
<?php $no++ ?>
@endforeach

@endsection