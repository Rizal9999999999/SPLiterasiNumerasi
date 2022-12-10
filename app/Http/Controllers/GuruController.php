<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function cetak()
    {
        $data['title'] = 'Laporan Data Guru';
        $data['rows'] = Guru::orderBy('nip')->get();
        return view('guru.cetak', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['q'] = $request->input('q');
        $data['title'] = 'Data Guru';
        $data['limit'] = 10;
        $data['rows'] = Guru::where('nama_guru', 'like', '%' . $data['q'] . '%')
            ->orderBy('nip')
            ->paginate($data['limit']);
        $data['no'] = $data['rows']->firstItem();
        return view('guru.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Guru';
        return view('guru.create', $data);
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
            'nip' => 'required|unique:tb_guru',
            'nama_guru' => 'required',
            'status_guru' => 'required',
            'password' => 'required',
        ], [
            'nip.required' => 'NISN harus diisi',
            'nip.unique' => 'NISN harus unik',
            'nama_guru.required' => 'Nama lengkap harus diisi',
            'status_guru.required' => 'Status harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $user = new User([
            'username' => $request->nip,
            'nama_user' => $request->nama_guru,
            'level' => 'Guru',
            'status_user' => $request->status_guru,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        $guru  = new Guru($request->all());
        $guru->id_user = $user->id_user;
        $guru->save();

        return redirect('guru')->with('message', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        $data['row'] = $guru;
        $data['title'] = 'Ubah Guru';
        return view('guru.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nama_guru' => 'required',
            'status_guru' => 'required',
        ], [
            'nama_guru.required' => 'Nama guru harus diisi',
            'status_guru.required' => 'Status harus diisi',
        ]);
        $guru->nama_guru = $request->nama_guru;
        $guru->status_guru = $request->status_guru;
        $guru->save();

        $user = User::find($guru->id_user);
        $user->nama_user = $guru->nama_guru;
        $user->status_user = $guru->status_guru;
        if ($request->password)
            $user->password = Hash::make($request->password);
        $user->save();
        return redirect('guru')->with('message', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        User::where('id_user', $guru->id_user)->delete();
        $guru->delete();
        return redirect('guru')->with('message', 'Data berhasil dihapus!');
    }
}
