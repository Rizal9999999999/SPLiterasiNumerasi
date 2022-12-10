@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th>No</th>
		<th>Kode</th>
		<th>Jenis</th>
		<th>Nama indikator</th>
		<th>Nilai</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->kode_indikator }}</td>
		<td>{{ $row->nama_jenis }}</td>
		<td>{{ $row->nama_indikator }}</td>
		<td>{{ $row->nilai }}</td>
	</tr>
	@endforeach
</table>
@endsection