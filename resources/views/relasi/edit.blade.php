@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('relasi.update', $row) }}" method="post">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{show_error($errors)}}
					{{ csrf_field() }}
					{{ method_field('PUT') }}
					<div class="form-group">
						<label>Kompetensi <span class="text-danger">*</span></label>
						<select class="form-control" name="kode_kompetensi">
							<?= get_kompetensi_option(old('kode_kompetensi', $row->kode_kompetensi)) ?>
						</select>
					</div>
					<div class="form-group">
						<label>Indikator <span class="text-danger">*</span></label>
						<select class="form-control" name="kode_indikator">
							<?= get_indikator_option(old('kode_indikator', $row->kode_indikator)) ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('relasi.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection