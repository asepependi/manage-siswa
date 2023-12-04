<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use DB, Str;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::withTrashed()->latest()->paginate(10);
        return view('pages.kelas.list', compact('kelas'));
    }

    public function create()
    {
        return view('pages.kelas.form');
    }

    public function store(Request $request)
    {
        $valid = \Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:20'
        ], [
            'nama_kelas.required' => 'Nama Kelas Tidak Boleh Kosong ',
            'nama_kelas.string' => 'Nama Kelas harus berupa teks'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid->errors())->withInput();
        }

        DB::beginTransaction();
        try {
            $data = [
                'kelas' => $request->nama_kelas,
                'slug' => Str::slug($request->nama_kelas)
            ];

            if (@$request->wali_kelas) {
                $data['guru_id'] = $request->wali_kelas;
            }

            Kelas::create($data);
            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Proses tambah data kelas sukses !');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function edit(Kelas $kelas)
    {
        return view('pages.kelas.form', compact('kelas'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $valid = \Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:20'
        ], [
            'nama_kelas.required' => 'Nama Kelas Tidak Boleh Kosong ',
            'nama_kelas.string' => 'Nama Kelas harus berupa teks'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid->errors())->withInput();
        }

        DB::beginTransaction();
        try {
            $data = [
                'kelas' => $request->nama_kelas,
                'slug' => Str::slug($request->nama_kelas)
            ];

            if (@$request->wali_kelas) {
                $data['guru_id'] = $request->wali_kelas;
            }

            $kelas->update($data);
            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Proses update data kelas sukses !');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy(Kelas $kelas)
    {
        DB::beginTransaction();
        try {
            $kelas->delete();
            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Proses delete data kelas sukses !');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function restore($slug)
    {
        DB::beginTransaction();
        try {
            $kelas = Kelas::onlyTrashed()->where('slug',$slug);
            $kelas->restore();
            DB::commit();

            return redirect()->route('kelas.index')->with('success', 'Proses Restore data kelas sukses !');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
