@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<form action="{{ route('user.profil.update') }}" method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{ show_error($errors) }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}" />
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="email" value="{{ old('email', $user->email) }}" />
                    </div>
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="username" value="{{ old('username', $user->username) }}" />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                        <input class="form-control" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" />
                    </div>
                    <div class="form-group">
                        <label>Umur <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="umur" value="{{ old('umur', $user->umur) }}" />
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-control" name="jk">
                            <?= get_jk_option(old('jk', $user->jk)) ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto </label>
                        <input class="form-control" type="file" name="foto" value="{{ old('foto', $user->foto) }}" />
                        <p class="form-text">Kosongkan jika tidak ingin mengubah gambar.</p>
                        <img src="{{ $user->image() }}" height="75" />
                    </div>
                    <div class="form-group">
                        <label>Jabatan </label>
                        <input class="form-control" type="text" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}" />
                    </div>
                    <div class="form-group">
                        <label>Alamat </label>
                        <input class="form-control" type="text" name="alamat" value="{{ old('alamat', $user->alamat) }}" />
                    </div>
                    <div class="form-group">
                        <label>Nomor PTUK </label>
                        <input class="form-control" type="text" name="no_ptuk" value="{{ old('no_ptuk', $user->no_ptuk) }}" />
                    </div>
                    <div class="form-group">
                        <label>Nama Sekolah </label>
                        <input class="form-control" type="text" name="nama_sekolah" value="{{ old('nama_sekolah', $user->nama_sekolah) }}" />
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