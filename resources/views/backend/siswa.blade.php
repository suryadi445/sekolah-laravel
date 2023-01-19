@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="offset-md-9 col-md-3">
                    <a href="{{ route('siswa.create') }}" class="btn btn-primary float-end">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped text-center text-capitalize">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Text</th>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">User</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($siswa))
                            @foreach ($siswa as $item)
                                <tr>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ $item->image }}" alt="image" width="100px">

                                            <a href="{{ route('siswa.remove', $item->id) }}" data-toggle="tooltip"
                                                title="Hapus Gambar" data-id="{{ $item->id }}" class="hapus_gambar">
                                                <button type="button" class="btn-close position-absolute"
                                                    aria-label="Close">
                                                </button>
                                            </a>
                                        @else
                                            <span class="badge text-bg-primary">
                                                Tidak Ada Gambar
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->judul }}</td>
                                    <td>{{ $item->text }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ getUser($item->user)->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning btn_edit"
                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#modal_edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ route('siswa.destroy', $item->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger btn_delete mt-2">
                                                <i class="fa-solid fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif


                        @if ($siswa->count() == 0)
                            <td colspan="7">
                                <span class="text-danger">Data Tidak Tersedia </span>
                            </td>
                        @endif
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-5">
                    {!! $siswa->links() !!}
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function() {

            $(document).on('click', '.btn_delete', function(e) {
                e.preventDefault()
                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Data Tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        form.submit();

                    }
                })
            })
        });
    </script>
@endsection
