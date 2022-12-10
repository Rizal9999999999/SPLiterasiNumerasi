<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Siswa';
        $data['rows'] = Siswa::orderBy('nisn')
            ->leftJoin('tb_kelas', 'tb_kelas.kode_kelas', '=', 'tb_siswa.kode_kelas')
            ->get();
        return view('siswa.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Siswa';
        $data['limit'] = 10;
        $data['rows'] = Siswa::where('nama_siswa', 'like', '%' . $data['q'] . '%')
            ->leftJoin('tb_kelas', 'tb_kelas.kode_kelas', '=', 'tb_siswa.kode_kelas')
            ->orderBy('nisn')
            ->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('siswa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Siswa';
        return view('siswa.create', $data);
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
            'nisn' => 'required|unique:tb_siswa',
            'nama_siswa' => 'required',
            'kode_kelas' => 'required',
            'status_siswa' => 'required',
            'password' => 'required',
        ], [
            'nisn.required' => 'NISN harus diisi',
            'nisn.unique' => 'NISN harus unik',
            'kode_kelas.required' => 'Kelas harus diisi',
            'nama_siswa.required' => 'Nama lengkap harus diisi',
            'status_siswa.required' => 'Status harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $user = new User([
            'username' => $request->nisn,
            'nama_user' => $request->nama_siswa,
            'level' => 'Siswa',
            'status_user' => $request->status_siswa,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        $siswa  = new Siswa($request->all());
        $siswa->id_user = $user->id_user;
        $siswa->save();

        return redirect('siswa')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $data['row'] = $siswa;
        $data['title'] = 'Ubah Siswa';
        return view('siswa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'kode_kelas' => 'required',
            'status_siswa' => 'required',
        ], [
            'nama_siswa.required' => 'Nama siswa harus diisi',
            'kode_kelas.required' => 'Kelas harus diisi',
            'status_siswa.required' => 'Status harus diisi',
        ]);
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->kode_kelas = $request->kode_kelas;
        $siswa->status_siswa = $request->status_siswa;
        $siswa->save();

        $user = User::find($siswa->id_user);
        $user->nama_user = $siswa->nama_siswa;
        $user->status_user = $siswa->status_siswa;
        if ($request->password)
            $user->password = Hash::make($request->password);
        $user->save();
        return redirect('siswa')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        User::where('id_user', $siswa->id_user)->delete();
        $siswa->delete();
        return redirect('siswa')->with('message', 'Data berhasil dihapus!');
    }
}
