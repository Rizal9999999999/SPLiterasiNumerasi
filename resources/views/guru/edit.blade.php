@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('guru.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>NIP <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nip" value="{{ old('nip', $row->nip) }}" readonly>
					</div>
					<div class="form-group">
						<label>Nama guru <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_guru" value="{{ old('nama_guru', $row->nama_guru) }}">
					</div>
					<div class="form-group">
						<label>Status <span class="text-danger">*</span></label>
						<select class="form-control" name="status_guru">
							<?= get_status_user_option(old('status_guru', $row->status_guru)) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input class="form-control" type="text" name="password" value="{{ old('password', $row->password) }}">
						<p class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('guru.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection