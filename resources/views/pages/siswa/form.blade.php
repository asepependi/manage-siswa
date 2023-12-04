@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between my-3 align-item-center">
        <div>
            <h2>Form Master Siswa</h2>
        </div>
    </div>
    <div>
        @php
            $route = @$siswa->slug ? 'siswa.update' : 'siswa.store';
        @endphp
        <form action="{{ route($route, @$siswa->slug) }}" method="POST">
            @csrf
            @if (@$siswa->slug)
                @method('put')
            @endif
            <div class="mb-3">
              <label for="kelaslable" class="form-label">Nama Kelas</label>
              <input name="nama_kelas" type="text" class="form-control" id="kelaslable" aria-describedby=""
                placeholder="Masukkan Nama Kelas" required value="{{ old('nama_kelas', @$siswa->kelas) }}">
            </div>
            <div class="mb-3">
                <label for="">Nama Wali Kelas</label>
                <select class="form-select" name="nama_guru" aria-label="Default select example">
                    <option value="">Choose One this Option</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
