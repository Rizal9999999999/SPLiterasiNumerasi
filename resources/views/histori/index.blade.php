@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card card-primary card-outline">
	<div class="card-header">
		<form class="form-inline">
			<div class="form-group mr-1">
				<input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Pencarian..." />
			</div>
			<div class="form-group mr-1">
				<button class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
			</div>
			<div class="form-group mr-1" {{ is_hidden('histori.cetak') }}>
				<a class="btn btn-default" href="{{ route('histori.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>No</th>
				<th>Waktu</th>
				<th>NISN</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Tanggal Lahir</th>
				<th>Umur</th>
				<th>Jenis</th>
				<th>Periode</th>
				<th>Kategori</th>
				<th>CF</th>
				<th>Aksi</th>
			</thead>
			@foreach($rows as $key => $row)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $row->histori_created_at }}</td>
				<td>{{ $row->nisn }}</td>
				<td>{{ $row->nama_user }}</td>
				<td>{{ $row->jk }}</td>
				<td>{{ format_date($row->tanggal_lahir) }}</td>
				<td>{{ $row->umur }}</td>
				<td>{{ $row->nama_jenis }}</td>
				<td>{{ $row->periode }}</td>
				<td>{{ $row->nama_solusi }}</td>
				<td style="background-color: <?= $row->warna ?> !important;">{{ round($row->cf, 2) }}%</td>
				<td>
					<a class="btn btn-xs btn-info" href="{{ route('histori.detail', ['id_histori' => $row->id_histori]) }}" {{ is_hidden('histori.detail') }}><i class="fa fa-eye"></i> Detail</a>
					<form action="{{ route('histori.destroy', $row) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('histori.destroy') }}>
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</button>
					</form>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
	@if ($rows->hasPages())
	<div class="card-footer">
		{{ $rows->links() }}
	</div>
	@endif
</div>
@endsection