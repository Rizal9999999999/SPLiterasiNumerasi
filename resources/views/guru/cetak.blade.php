@extends('layout.print')
@section('title', $title)
@section('content')
<table class="table table-bordered table-hover">
	<thead>
		<th>No</th>
		<th>NIP</th>
		<th>Nama guru</th>
	</thead>
	<?php $no = 1 ?>
	@foreach($rows as $key => $row)
	<tr>
		<td>{{ $no++ }}</td>
		<td>{{ $row->nip }}</td>
		<td>{{ $row->nama_guru }}</td>
	</tr>
	@endforeach
</table>
@endsection