@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th>No</th>
		<th>Waktu</th>
		<th>Nama</th>
		<th>Jenis Kelamin</th>
		<th>Tanggal Lahir</th>
		<th>Umur</th>
		<th>Jenis</th>
		<th>Periode</th>
		<th>Kategori</th>
		<th>CF</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->histori_created_at }}</td>
		<td>{{ $row->nama_user }}</td>
		<td>{{ $row->jk }}</td>
		<td>{{ format_date($row->tanggal_lahir) }}</td>
		<td>{{ $row->umur }}</td>
		<td>{{ $row->nama_jenis }}</td>
		<td>{{ $row->periode }}</td>
		<td>{{ $row->nama_solusi }}</td>
		<td>{{ round($row->cf, 2) }}%</td>
	</tr>
	@endforeach
</table>
@endsection