@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th>No</th>
		<th>NISN</th>
		<th>Kelas</th>
		<th>Nama siswa</th>
		<th>Status</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->nisn }}</td>
		<td>{{ $row->nama_kelas }}</td>
		<td>{{ $row->nama_siswa }}</td>
		<td>{{ $row->status_siswa ? 'Aktif' : 'NonAktif' }}</td>
	</tr>
	@endforeach
</table>
@endsection