@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th>No</th>
		<th>Kompetensi</th>
		<th>Relasi</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>[{{ $row->kode_kompetensi }}] {{ $row->nama_kompetensi }}</td>
		<td>[{{ $row->kode_indikator }}] {{ $row->nama_indikator }}</td>
	</tr>
	@endforeach
</table>
@endsection