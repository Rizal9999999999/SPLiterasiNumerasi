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
			<div class="form-group mr-1" {{ is_hidden('siswa.create') }}>
				<a class="btn btn-primary" href="{{ route('siswa.create') }}"><i class="fa fa-plus"></i> Tambah</a>
			</div>
			<div class="form-group mr-1" {{ is_hidden('siswa.cetak') }}>
				<a class="btn btn-default" href="{{ route('siswa.cetak') }}" target="_blank"><span class="fa fa-print"></span> Cetak</a>
			</div>
		</form>
	</div>
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>No</th>
				<th>NISN</th>
				<th>Kelas</th>
				<th>Nama siswa</th>
				<th>Status</th>
				<th>Aksi</th>
			</thead>
			@foreach($rows as $key => $row)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $row->nisn }}</td>
				<td>{{ $row->nama_kelas }}</td>
				<td>{{ $row->nama_siswa }}</td>
				<td>{{ $row->status_siswa ? 'Aktif' : 'NonAktif' }}</td>
				<td>
					<a class="btn btn-xs btn-info" href="{{ route('siswa.edit', $row) }}" {{ is_hidden('siswa.edit') }}><i class="fa fa-edit"></i> Ubah</a>
					<form action="{{ route('siswa.destroy', $row) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Hapus Data?')" {{ is_hidden('siswa.destroy') }}>
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