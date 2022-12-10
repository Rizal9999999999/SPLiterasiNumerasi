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
			<div class="form-group mr-1" {{ is_hidden('relasi.create') }}>
				<a class="btn btn-primary" href="{{ route('relasi.create') }}"><i class="fa fa-plus"></i> Tambah</a>
			</div>
			<div class="form-group mr-1" {{ is_hidden('relasi.aturan') }}>
				<a class="btn btn-info" href="{{ route('relasi.aturan') }}"><i class="fa fa-calendar"></i> Aturan</a>
			</div>
			<div class="form-group mr-1" {{ is_hidden('relasi.cetak') }}>
				<a class="btn btn-default" href="{{ route('relasi.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>No</th>
				<th>Kompetensi</th>
				<th>Indikator</th>
				<th>Aksi</th>
			</thead>
			@foreach($rows as $key => $row)
			<tr>
				<td>{{ ($rows->currentPage() - 1) * $limit + $key + 1}}</td>
				<td>[{{ $row->kode_kompetensi }}] {{ $row->nama_kompetensi }}</td>
				<td>[{{ $row->kode_indikator }}] {{ $row->nama_indikator }}</td>
				<td>
					<a class="btn btn-xs btn-info" href="{{ route('relasi.edit', $row) }}" {{ is_hidden('relasi.edit') }}><i class="fa fa-edit"></i> Ubah</a>
					<form action="{{ route('relasi.destroy', $row) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('relasi.destroy') }}>
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