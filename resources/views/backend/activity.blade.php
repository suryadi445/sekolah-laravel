@extends('layouts.admin.admin')

@section('admin')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/activity/exportPdf" target="_blank" class="btn btn-success">
                                    <span class="me-1">Print PDF</span>
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="/activity/exportExcel" target="_blank" class="btn btn-warning">
                                    <span class="me-1">Print Excel</span>
                                    <i class="fa-solid fa-file-excel"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mt-2 mt-sm-0">
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#modal_add">
                                <i class="fa-solid fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
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
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Text</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($activity))
                                    @foreach ($activity as $item)
                                        <tr>
                                            <td><img src="{{ $item->image }}" alt="image" width="100px"></td>
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
                                                <form method="POST" action="{{ route('activity.destroy', $item->id) }}">
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


                                @if ($activity->count() == 0)
                                    <td colspan="6">
                                        <span class="text-danger">Data Tidak Tersedia </span>
                                    </td>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {!! $activity->links() !!}
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
                <form action="{{ route('activity.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label fw-bold">Gambar</label>
                            <input class="form-control" type="file" id="formFileMultiple" name="image">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Judul" name="judul"
                                value="{{ old('judul') }}">
                            <label for="judul">Judul Berita</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="text"
                                value="{{ old('text') }}" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Text</label>
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

                        <div id="" class="form-text text-danger">Image sebelumnya</div>
                        <img src="" alt="image" id="image" width="100px" height="100px">

                        <div class="mb-3 mt-3">
                            <label for="formFileMultiple" class="form-label fw-bold">Gambar</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="judul" placeholder="Judul"
                                name="judul" value="{{ old('judul') }}">
                            <label for="judul">Judul Berita</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="text" name="text"
                                style="height: 100px"></textarea>
                            <label for="text">Text</label>
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
            $(document).on('click', '.btn_edit', function() {
                $('#image').addClass('d-none');
                var id = $(this).attr('data-id')
                $.get("{{ route('activity.index') }}" + '/' + id + '/edit', function(data) {
                    $('#image').attr('src', data.image);
                    $('#id').val(id);
                    $('#text').val(data.text);
                    $('#judul').val(data.judul);
                    $('#image').removeClass('d-none');
                    $('#form_edit').attr('action', "{{ route('activity.index') }}" + '/' + id);

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
                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                    }
                })
            })
        });
    </script>
@endsection
