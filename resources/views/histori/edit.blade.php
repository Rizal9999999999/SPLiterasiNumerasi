@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('kompetensi.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>Kode kompetensi <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_kompetensi" value="{{ old('kode_kompetensi', $row->kode_kompetensi) }}" readonly>
					</div>
					<div class="form-group">
						<label>Nama kompetensi <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_kompetensi" value="{{ old('nama_kompetensi', $row->nama_kompetensi) }}">
					</div>
					<div class="form-group">
						<label>Detail <span class="text-danger">*</span></label>
						<textarea class="form-control" name="detail">{{ old('detail', $row->detail) }}</textarea>
					</div>
					<div class="form-group">
						<label>Solusi <span class="text-danger">*</span></label>
						<textarea class="form-control" name="solusi">{{ old('solusi', $row->solusi) }}</textarea>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('kompetensi.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection