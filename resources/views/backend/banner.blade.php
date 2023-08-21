@extends('layouts.admin.admin')

@section('admin')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="offset-md-9 col-md-3">
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
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Kategori Halaman</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Text</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($banners))
                                    @foreach ($banners as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td><img src="{{ $item->image }}" alt="image" width="100px"></td>
                                            <td>{{ $item->kategori }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->text }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ getUser($item->user)->name ?? '' }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning btn_edit"
                                                    data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#modal_edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    Edit
                                                </button>
                                                <form method="POST" action="{{ route('banner.destroy', $item->id) }}">
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


                                @if (count($banners) == 0)
                                    <td colspan="8">
                                        <span class="text-danger">Data Tidak Tersedia </span>
                                    </td>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {!! $banners->links() !!}
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
                <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input class="form-control" type="file" id="gambar" name="image">
                            <small class="text-danger">Gunakan foto landscape (mendatar) untuk hasil terbaik</small>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="kategori" name="kategori">
                                <option selected disabled value="">Pilih Halaman</option>
                                <option value="About">About</option>
                                <option value="Guru">Guru</option>
                                <option value="Siswa">Siswa</option>
                                <option value="Pengumuman">Pengumuman</option>
                                <option value="Agenda">Agenda</option>
                                <option value="Gallery">Gallery</option>
                                <option value="Alumni">Alumni</option>
                            </select>
                            <label for="kategori">Kategori Halaman</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul">
                            <label for="judul">Judul</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" name="text" id="text" style="height: 100px"></textarea>
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

                        <div id="" class="form-text text-danger">Image Sebelumnya</div>
                        <img src="" alt="image" id="image" width="100px" height="100px">
                        <div class="mb-3 mt-3">
                            <input class="form-control" type="file" id="image" name="image">
                            <small class="text-danger">Gunakan foto landscape (mendatar) untuk hasil terbaik</small>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" id="kategori_edit" name="kategori">
                                <option selected disabled value="">Pilih Halaman</option>
                                <option value="About">About</option>
                                <option value="Guru">Guru</option>
                                <option value="Siswa">Siswa</option>
                                <option value="Pengumuman">Pengumuman</option>
                                <option value="Agenda">Agenda</option>
                                <option value="Gallery">Gallery</option>
                            </select>
                            <label for="kategori">Kategori Halaman</label>
                        </div>
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" name="judul" id="judul_edit"
                                placeholder="Judul">
                            <label for="judul">Judul</label>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" name="text" id="text_edit"
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
                $.get("{{ route('banner.index') }}" + '/' + id + '/edit', function(
                    data) {
                    $('#image').attr('src', data.image);
                    $('#image').removeClass('d-none');
                    $('#kategori_edit').val(data.kategori);
                    $('#judul_edit').val(data.judul);
                    $('#text_edit').val(data.text);
                    $('#form_edit').attr('action', "{{ route('banner.index') }}" + '/' + id);

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
