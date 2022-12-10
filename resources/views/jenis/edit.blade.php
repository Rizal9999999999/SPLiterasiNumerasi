@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('jenis.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>Kode jenis <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_jenis" value="{{ old('kode_jenis', $row->kode_jenis) }}" readonly>
					</div>
					<div class="form-group">
						<label>Nama jenis <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_jenis" value="{{ old('nama_jenis', $row->nama_jenis) }}">
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('jenis.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection