@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('event.store') }}" method="POST">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					{{ show_error($errors) }}
					{{ csrf_field() }}
					<div class="form-group">
						<label>Nama Event <span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="nama_event" value="{{ old('nama_event') }}" />
					</div>
					<div class="form-group">
						<label>Start <span class="text-danger">*</span></label>
						<input class="form-control" type="date" name="start" value="{{ old('start', date('Y-m-d')) }}" />
					</div>
					<div class="form-group">
						<label>End <span class="text-danger">*</span></label>
						<input class="form-control" type="date" name="end" value="{{ old('end', date('Y-m-d')) }}" />
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			<a class="btn btn-danger" href="{{ route('event.index') }}"><i class="fa fa-backward"></i> Kembali</a>
		</div>
	</div>
</form>
@endsection