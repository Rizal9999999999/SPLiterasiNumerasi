@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('siswa.store') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>NISN <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nisn" value="{{ old('nisn', kode_oto('nisn', 'tb_siswa', date('Y'), 3)) }}" />
					</div>
					<div class="form-group">
						<label>Kelas <span class="text-danger">*</span></label>
						<select class="form-control" name="kode_kelas">
							<?= get_kelas_option(old('kode_kelas')) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Nama siswa <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" />
					</div>
					<div class="form-group">
						<label>Status <span class="text-danger">*</span></label>
						<select class="form-control" name="status_siswa">
							<?= get_status_user_option(old('status_siswa')) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Password <span class="text-danger">*</span></label>
						<input class="form-control" type="password" name="password" value="{{ old('password') }}" />
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('siswa.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection