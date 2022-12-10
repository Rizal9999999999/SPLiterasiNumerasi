@extends('layout.app')
@section('title', $title)
@section('content')
<form action="{{ route('hitung.action') }}" method="POST">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{ show_error($errors) }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Jenis <span class="text-danger">*</span></label>
                        <select class="form-control" name="kode_jenis">
                            <?= get_jenis_option(old('kode_jenis')) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Periode <span class="text-danger">*</span></label>
                        <select class="form-control" name="periode">
                            <?= get_periode_option(old('periode')) ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Selanjutnya</button>
        </div>
    </div>
</form>
@endsection