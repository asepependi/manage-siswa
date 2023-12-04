@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between my-3 align-item-center">
        <div>
            <h2>List Master Kelas</h2>
        </div>
        <div>
            <a href="{{ route('siswa.create') }}" class="btn btn-success">Tambah</a>
        </div>
    </div>
    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">No Telp</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswa as $item)
                <tr>
                    <td scope="row">{{ $loop->iteration + $siswa->firstItem() - 1 }}</td>
                    <td>{{ $item->nis }}</td>
                    <td>{{ $item->nama_siswa }}</td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>
                        @if ($item->deleted_at)
                        <form action="{{ route('siswa.restore', $item->slug) }}" method="post">
                            @csrf
                            <button class="btn btn-warning">Restore</a>
                        </form>
                        @else
                        <form action="{{ route('siswa.destroy', $item->slug) }}" method="post">
                            <a href="{{ route('siswa.edit', $item->slug) }}" class="btn btn-primary">Edit</a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ?')">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="6">Data not found !</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div>
        <div class="text-end">
            {{ $siswa->links() }}
        </div>
    </div>
</div>
@endsection
