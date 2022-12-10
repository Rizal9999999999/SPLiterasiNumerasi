@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('jenis.store') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>Kode <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_jenis" value="{{ old('kode_jenis', kode_oto('kode_jenis', 'tb_jenis', 'J', 3)) }}" />
					</div>
					<div class="form-group">
						<label>Nama jenis <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_jenis" value="{{ old('nama_jenis') }}" />
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