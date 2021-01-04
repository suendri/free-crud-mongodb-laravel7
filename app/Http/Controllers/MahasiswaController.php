<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mahasiswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'mhsw_nim' => 'bail|required|unique:tb_mhsw,mhsw_nim',
                'mhsw_nama' => 'required',
                'mhsw_alamat' => 'nullable',
                'mhsw_prodi' => 'nullable'
            ],
            [
                'mhsw_nim.required' => 'NIM Wajib Diisi',
                'mhsw_nama.required' => 'Nama Wajib Diisi'
            ]
        );

        Mahasiswa::create([
            'mhsw_nim' => $request->mhsw_nim,
            'mhsw_nama' => $request->mhsw_nama,
            'mhsw_alamat' => $request->mhsw_alamat,
            'mhsw_prodi' => $request->mhsw_prodi
        ]);

        $request->session()->flash('alert-success', 'Data berhasil disimpan!');
        return redirect('/dashboard/mahasiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Mahasiswa::find($id);
        return view('mahasiswa.show', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'mhsw_nim' => 'required',
                'mhsw_nama' => 'required',
                'mhsw_alamat' => 'nullable',
                'mhsw_prodi' => 'nullable'
            ],
            [
                'mhsw_nim.required' => 'NIM Wajib Diisi',
                'mhsw_nama.required' => 'Nama Wajib Diisi'
            ]
        );

        $row = Mahasiswa::findOrFail($id);
        $any = Mahasiswa::where([
            ['mhsw_nim', '=', $request->mhsw_nim],
            ['_id', '<>', $id]
        ])->first();

        if ($row != null && $any === null) {
            $row->update([
                'mhsw_nim' => $request->mhsw_nim,
                'mhsw_nama' => $request->mhsw_nama,
                'mhsw_alamat' => $request->mhsw_alamat,
                'mhsw_prodi' => $request->mhsw_prodi
            ]);
            $request->session()->flash('alert-success', 'Data berhasil diperbarui!');
        } else {
            $request->session()->flash('alert-warning', 'Data gagal diperbarui!');
        }
        
        return redirect('/dashboard/mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $row = Mahasiswa::findOrFail($id);
        $row->delete();

        $request->session()->flash('alert-success', 'Data berhasil dihapus!');
        return redirect('/dashboard/mahasiswa');
    }
}
