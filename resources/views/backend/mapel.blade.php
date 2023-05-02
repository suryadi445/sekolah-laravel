@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/mapel/exportPdf" target="_blank" class="btn btn-success">
                                    <span class="me-1">Print PDF</span>
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="/mapel/exportExcel" target="_blank" class="btn btn-warning">
                                    <span class="me-1">Print Excel</span>
                                    <i class="fa-solid fa-file-excel"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3 mt-sm-0">
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#modal_add">
                                <i class="fa-solid fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table
                                    class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden">
                                    <thead class="bg-dark text-light">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th scope="col">Mata Pelajaran</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Tanggal Dibuat</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @if (!empty($mapel))
                                            @foreach ($mapel as $item)
                                                <tr>

                                                    <td>{{ $item->mata_pelajaran }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ getUser($item->user)->name ?? '' }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning btn_edit"
                                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Edit
                                                        </button>
                                                        <form method="POST"
                                                            action="{{ route('mapel.destroy', $item->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger btn_delete mt-2">
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif


                                        @if ($mapel->count() == 0)
                                            <td colspan="7">
                                                <span class="text-danger">Data Tidak Tersedia </span>
                                            </td>
                                        @endif
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $mapel->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mapel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" placeholder="Leave a comment here"
                                name="mata_pelajaran" value="{{ old('mata_pelajaran') }}">
                            <label for="mata_pelajaran">Mata Pelajaran</label>
                        </div>
                        <div class="form-floating mt-3">
                            <textarea class="form-control" placeholder="Leave a comment here" name="keterangan" style="height: 100px">{{ old('keterangan') }}</textarea>
                            <label for="keterangan">Keterangan</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" id="form_edit">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">

                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" placeholder="Leave a comment here"
                                id="mata_pelajaran" name="mata_pelajaran">
                            <label for="mata_pelajaran">Mata Pelajaran</label>
                        </div>
                        <div class="form-floating mt-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="keterangan" name="keterangan"
                                style="height: 100px"></textarea>
                            <label for="keterangan">Keterangan</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function() {

            $(document).on('click', '.hapus_gambar', function(e) {
                e.preventDefault()
                url = $(this).attr('href')
                window.location.href = url;
            })

            $(document).on('click', '.btn_edit', function() {
                var id = $(this).attr('data-id')
                $.get("{{ route('mapel.index') }}" + '/' + id + '/edit', function(data) {
                    $('#id').val(id);
                    $('#mata_pelajaran').val(data.mata_pelajaran);
                    $('#keterangan').val(data.keterangan);
                    $('#form_edit').attr('action', "{{ route('mapel.index') }}" + '/' + id);

                })
            })

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
