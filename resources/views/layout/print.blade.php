<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Cetak @yield('title')</title>

    <link rel="icon" href="{{ asset('images/sekolah.png') }}">
    <link rel="stylesheet" href="{{asset('adminlte3/dist/css/adminlte.min.css')}}">
    <style>

    </style>
</head>

<body onload="//window.print()">
    <header class="container mb-3">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset('images/sekolah.png') }}" height="100" />
            </div>
            <div class="col-md-10 text-center" style="line-height: 1;">
                <div style="font-size: 2em;">SEKOLAH DASAR ISLAM “WALI SONGO”</div>
                <div style="font-size: 1.5em;">NPSN. 69957215</div>
                <div style="font-size: 1.2em;">Alamat : Desa Temon Kecamatan Trowulan Kabupaten Mojokerto</div>
                <div style="font-size: 1.1em;">Kode Pos. 61362 No. Telp.085105966226</div>
            </div>
        </div>
        <div class="border-top border-bottom" style="border-top-width: 3px !important; border-color: black !important"></div>
    </header>
    <section class="container">
        <h1>@yield('title')</h1>
        @yield('content')
    </section>

</body>

</html>