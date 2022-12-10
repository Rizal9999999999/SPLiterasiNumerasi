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
			<div class="form-group mr-1" {{ is_hidden('solusi.create') }}>
				<a class="btn btn-primary" href="{{ route('solusi.create') }}"><i class="fa fa-plus"></i> Tambah</a>
			</div>
			<div class="form-group mr-1" {{ is_hidden('solusi.cetak') }}>
				<a class="btn btn-default" href="{{ route('solusi.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>No</th>
				<th>Kode</th>
				<th>Kategori</th>
				<th>Solusi</th>
				<th>Nilai</th>
				<th>Warna</th>
				<th>Aksi</th>
			</thead>
			@foreach($rows as $key => $row)
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
				<td>{{ $row->kode_solusi }}</td>
				<td>{{ $row->nama_solusi }}</td>
				<td>{!! br_to_enter($row->detail_solusi) !!}</td>
				<td>{{ $row->min_nilai }} - {{ $row->max_nilai }}</td>
				<td style="background-color: <?= $row->warna ?> !important;"></td>
				<td>
					<a class="btn btn-xs btn-info" href="{{ route('solusi.edit', $row) }}" {{ is_hidden('solusi.edit') }}><i class="fa fa-edit"></i> Ubah</a>
					<form action="{{ route('solusi.destroy', $row) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('solusi.destroy') }}>
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