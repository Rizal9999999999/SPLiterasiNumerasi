@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th>No</th>
		<th>Kode</th>
		<th>Kategori</th>
		<th>Solusi</th>
		<th>Nilai</th>
		<th>Aksi</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->kode_solusi }}</td>
		<td>{{ $row->nama_solusi }}</td>
		<td>{!! br_to_enter($row->detail_solusi) !!}</td>
		<td>{{ $row->min_nilai }} - {{ $row->max_nilai }}</td>
	</tr>
	@endforeach
</table>
@endsection