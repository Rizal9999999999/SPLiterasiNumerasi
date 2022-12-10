<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profil()
    {
        $data['title'] = 'Ubah Profil';
        $data['user'] = Auth::user();
        return view('user.profil', $data);
    }

    public function profilUpdate(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'username' => 'required',
            'tanggal_lahir' => 'required',
            'umur' => 'required',
            'jk' => 'required',
        ], [
            'nama_user.required' => 'Nama lengkap harus diisi',
            'username.required' => 'Username harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'umur.required' => 'Umur harus diisi',
            'jk.required' => 'Jenis kelamin harus diisi',
        ]);
        $user = current_user();
        if (get_row("SELECT * FROM tb_user WHERE username='{$request->username}' AND id_user<>'$user->id_user'"))
            return back()->withErrors([
                'username' => 'Username sudah terdaftar!',
            ]);
        $user->nama_user = $request->nama_user;
        $user->username = $request->username;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->umur = $request->umur;
        $user->jk = $request->jk;
        $user->jabatan = $request->jabatan;
        $user->alamat = $request->alamat;
        $user->no_ptuk = $request->no_ptuk;
        $user->nama_sekolah = $request->nama_sekolah;

        if ($request->hasFile('foto')) {
            $user->delete_image();
            $image = $request->file('foto');
            $name = rand(1000, 9999) . $image->getClientOriginalName();
            $image->move('images/user', $name);
            $user->foto = $name;
        }

        $user->save();
        $request->session()->regenerate();
        return back()->with('message', 'Data berhasil diubah!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function password()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = Auth::user();
        return view('user.password', $data);
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'pass1' => 'required',
            'pass2' => 'required|confirmed',
        ], [
            'pass1.required' => 'Password lama harus diisi',
            'pass2.required' => 'Password baru harus diisi',
            'pass2.confirmed' => 'Password baru dan konfirmasi password baru harus sama',
        ]);
        $user = current_user();
        if (!Hash::check($request->pass1, $request->user()->password))
            return back()->withErrors([
                'username' => 'Password lama salah!',
            ]);

        $user->password = Hash::make($request->pass2);
        $user->save();
        $request->session()->regenerate();
        return back()->with('message', 'Data berhasil diubah!');
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function loginAction(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'Salah kombinasi username dan password',
        ]);
    }
    public function daftarForm()
    {
        $data['title'] = 'Daftar';
        return view('user.daftar', $data);
    }
    public function daftarAction(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:tb_siswa',
            'nama_siswa' => 'required',
            'password' => 'required',
            'password2' => 'required|same:password',
        ], [
            'nama_siswa.required' => 'Nama lengkap harus diisi',
            'nisn.required' => 'NISN harus diisi',
            'nisn.unique' => 'NISN harus unik',
            'password.required' => 'Password harus diisi',
            'password2.required' => 'Konfirmasi Password harus diisi',
            'password2.same' => 'Password dan Konfirmasi Password harus diisi',
        ]);

        $user = new User([
            'username' => $request->nisn,
            'nama_user' => $request->nama_siswa,
            'level' => 'Siswa',
            'status_user' => 1,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        $siswa  = new Siswa($request->all());

        $siswa->id_user = $user->id_user;
        $siswa->save();

        return redirect()->route('login')->with('message', 'Pendaftaran berhasil, silahkan login!');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data User';
        $data['limit'] = 10;
        $data['rows'] = User::where('nama_user', 'like', '%' . $data['q'] . '%')
            ->whereIn('level', ['Admin', 'User'])
            ->orderBy('id_user')
            ->paginate($data['limit']);
        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah User';
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required',
            'username' => 'required|unique:tb_user',
            'password' => 'required',
            'level' => 'required',
            'status_user' => 'required',
        ], [
            'nama_user.required' => 'Nama user harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username harus unik',
            'password.required' => 'Password harus diisi',
            'level.required' => 'Level harus diisi',
            'status_user.required' => 'Status harus diisi',
        ]);
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('user')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['row'] = $user;
        $data['title'] = 'Ubah User';
        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama_user' => 'required',
            'username' => 'required',
            'level' => 'required',
            'status_user' => 'required',
        ], [
            'nama_user.required' => 'Nama user harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username harus unik',
            'level.required' => 'Level harus diisi',
            'status_user.required' => 'Status harus diisi',
        ]);

        if (get_row("SELECT * FROM tb_user WHERE username='{$request->username}' AND id_user<>'$user->id_user'"))
            return back()->withErrors([
                'username' => 'Username sudah terdaftar!',
            ]);

        $user->nama_user = $request->nama_user;
        $user->username = $request->username;
        if ($request->password)
            $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->status_user = $request->status_user;
        $user->save();
        return redirect('user')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('user')->with('message', 'Data berhasil dihapus!');
    }
}
