@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('indikator.update', $row) }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>Kode <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_indikator" value="{{ $row->kode_indikator }}" readonly />
					</div>
					<div class="form-group">
						<label>Jenis <span class="text-danger">*</span></label>
						<select class="form-control" name="kode_jenis">
							<?= get_jenis_option(old('kode_jenis', $row->kode_jenis)) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Nama indikator <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_indikator" value="{{ old('nama_indikator', $row->nama_indikator) }}">
					</div>
					<div class="form-group">
						<label>Nilai <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nilai" value="{{ old('nilai', $row->nilai) }}">
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('indikator.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection