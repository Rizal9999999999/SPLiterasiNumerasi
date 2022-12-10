@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('daftar.action') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>NISN <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nisn" value="{{ old('nisn') }}" />
					</div>
					<div class="form-group">
						<label>Nama Lengkap <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" />
					</div>
					<div class="form-group">
						<label>Password <span class="text-danger">*</span></label>
						<input class="form-control" type="password" name="password" value="{{ old('password') }}" />
					</div>
					<div class="form-group">
						<label>Konfirmasi Password <span class="text-danger">*</span></label>
						<input class="form-control" type="password" name="password2" value="{{ old('password2') }}" />
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
		</div>
	</div>
</form>
@endsection