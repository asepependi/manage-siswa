<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::withTrashed()->latest()->paginate(10);
        return view('pages.siswa.list', compact('siswa'));
    }

    public function create()
    {
        return view('pages.siswa.form');
    }
}
