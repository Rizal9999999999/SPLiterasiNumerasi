@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('solusi.store') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>Kode <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="kode_solusi" value="{{ old('kode_solusi', kode_oto('kode_solusi', 'tb_solusi', 'K', 2)) }}" />
					</div>
					<div class="form-group">
						<label>Kategori <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_solusi" value="{{ old('nama_solusi') }}" />
					</div>
					<div class="form-group">
						<label>Solusi <span class="text-danger">*</span></label>
						<textarea class="form-control" name="detail_solusi">{{ old('detail_solusi') }}</textarea>
					</div>
					<div class="form-group">
						<label>Min Nilai <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="min_nilai" value="{{ old('min_nilai') }}" />
					</div>
					<div class="form-group">
						<label>Max Nilai <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="max_nilai" value="{{ old('max_nilai') }}" />
					</div>
					<div class="form-group">
						<label>Warna <span class="text-danger">*</span></label>
						<input class="form-control" type="color" name="warna" value="{{ old('warna') }}" />
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('solusi.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection