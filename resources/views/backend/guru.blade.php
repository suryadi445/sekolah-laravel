@extends('layouts.admin.admin')

@section('admin')

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="offset-md-6 col-md-4">
                                    <div class="row">
                                        <form action="{{ route('guru.index') }}" method="get">
                                            <div class="input-group">
                                                <input type="text" name="cari" id="cari"
                                                    class="form-control shadow mb-3 bg-body rounded" placeholder="Cari guru"
                                                    value="{{ request('cari') }}" aria-label="Recipient's username"
                                                    aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button type="submit"
                                                        class="input-group-text bg-info shadow mb-3 rounded"
                                                        id="basic-addon2">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('guru.create') }}" class="btn btn-primary float-end">
                                        <i class="fa-solid fa-plus"></i>
                                        Tambah Data
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 mt-2 table-responsive">
                    <table
                        class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">NIK</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pendidikan Terakhir</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Nomor Handphone</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($guru))
                                @foreach ($guru as $item)
                                    <tr>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>
                                            @if ($item->image)
                                                <img src="{{ $item->image }}" alt="image" width="50">
                                            @else
                                                <span class="badge text-bg-success">Tidak Ada Foto</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->nama_guru . ' ' . $item->gelar }}</td>
                                        <td>{{ $item->pendidikan_terakhir }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->tgl_lahir }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('guru.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning btn_edit me-2">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('guru.destroy', $item->id) }}">
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


                            @if ($guru->count() == 0)
                                <td colspan="10">
                                    <span class="text-danger">Data Tidak Tersedia </span>
                                </td>
                            @endif
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {!! $guru->links() !!}
                    </div>
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
