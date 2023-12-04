@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between my-3 align-item-center">
        <div>
            <h2>List Master Kelas</h2>
        </div>
        <div>
            <a href="{{ route('kelas.create') }}" class="btn btn-success">Tambah</a>
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
                <th scope="col">Kelas</th>
                <th scope="col">Wali Kelas</th>
                <th scope="col">Status</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kelas as $item)
                @php
                    $active = @$item->deleted_at ? true : false;
                    $activeText = @$item->deleted_at ? 'Non Active' : 'Active'
                @endphp
                <tr>
                    <th scope="row">{{ $loop->iteration + $kelas->firstItem() - 1 }}</th>
                    <td>{{ $item->kelas }}</td>
                    <td>-</td>
                    <td>
                        <span
                            @class([
                                'badge',
                                'text-bg-success' => !$active,
                                'text-bg-danger' => $active,
                            ])>
                            {{$activeText}}
                        </span>
                    </td>
                    <td>
                        @if ($item->deleted_at)
                        <form action="{{ route('kelas.restore', $item->slug) }}" method="post">
                            @csrf
                            <button class="btn btn-warning">Restore</a>
                        </form>
                        @else
                        <form action="{{ route('kelas.destroy', $item->slug) }}" method="post">
                            <a href="{{ route('kelas.edit', $item->slug) }}" class="btn btn-primary">Edit</a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ?')">Hapus</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr class="text-center">
                    <td colspan="5">Data not found !</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div>
        <div class="text-end">
            {{ $kelas->links() }}
        </div>
    </div>
</div>
@endsection
