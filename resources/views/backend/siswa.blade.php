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
                            <th scope="col">NIS</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($siswa))
                            @foreach ($siswa as $item)
                                <tr>
                                    <td>{{ $item->nis }}</td>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ $item->image }}" alt="image" width="50">
                                        @else
                                            <span class="badge text-bg-success">Tidak Ada Foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->nama_siswa }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->tgl_lahir }}</td>
                                    <td>{{ $item->thn_ajaran }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('siswa.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning btn_edit me-2">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('siswa.destroy', $item->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger btn_delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
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
