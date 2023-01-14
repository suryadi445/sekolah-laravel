@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="offset-md-9 col-md-3">
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modal_add">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Data
                    </button>
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
                            <th scope="col">Halaman</th>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">User</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($default))
                            @foreach ($default as $item)
                                @php
                                    $url = explode('/', $item->url);
                                @endphp
                                <tr>
                                    <td>
                                        @if ($item->image)
                                            <img src="{{ $item->image }}" alt="image" width="100px">
                                        @endif
                                    </td>
                                    <td>{{ $url[0] . " ( $url[1] Sekolah )" }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ getUser($item->user)->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning btn_edit"
                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#modal_edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Edit
                                        </button>
                                        <form method="POST" action="/default/{{ $item->id }}">
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


                        @if ($default->count() == 0)
                            <td colspan="7">
                                <span class="text-danger">Data Tidak Tersedia </span>
                            </td>
                        @endif
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-5">
                    {!! $default->links() !!}
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
                <form action="/default/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating">
                            <select class="form-select" id="floatingSelect" name="url" required>
                                <option selected disabled value="">Pilih Kategori</option>
                                <option value="profile">Profile Sekolah</option>
                                <option value="sejarah">Sejarah Sekolah</option>
                            </select>
                            <label for="floatingSelect">Kategori</label>
                        </div>
                        <div class="mb-3 mt-3">
                            <input class="form-control" type="file" id="formFileMultiple" name="image" required>
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
                            <input class="form-control" type="file" id="image" name="image" required>
                        </div>
                        <div class="form-floating mt-3">
                            <select class="form-select" id="url" name="url" required>
                                <option selected disabled value="">Pilih Kategori</option>
                                <option value="profile">Profile Sekolah</option>
                                <option value="sejarah">Sejarah Sekolah</option>
                            </select>
                            <label for="url">Kategori</label>
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
            $('[data-toggle="popover"]').popover();

            $(document).on('click', '.hapus_gambar', function(e) {
                e.preventDefault()
                url = $(this).attr('href')
                window.location.href = url;
            })

            $(document).on('click', '.btn_edit', function() {
                $('#image').addClass('d-none');
                var id = $(this).attr('data-id')
                $.get("/default" + '/' + id, function(data) {
                    let url_db = data.url;
                    let url_edit = url_db.split("/");

                    $('#image').attr('src', data.image);
                    $('#id').val(id);
                    $('#url').val(url_edit[1]);
                    $('#image').removeClass('d-none');
                    $('#form_edit').attr('action', "/default/" + id);

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
