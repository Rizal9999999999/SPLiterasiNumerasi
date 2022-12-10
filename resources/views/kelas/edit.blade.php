@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('kelas.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>Kode kelas <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_kelas" value="{{ old('kode_kelas', $row->kode_kelas) }}" readonly>
					</div>
					<div class="form-group">
						<label>Nama kelas <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_kelas" value="{{ old('nama_kelas', $row->nama_kelas) }}">
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('kelas.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection