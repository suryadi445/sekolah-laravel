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
                    <div class="alert alert-primary" role="alert">
                        Data otomatis dari kelulusan siswa, bisa ditambah manual jika diperlukan!
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table
                            class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden data-table">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Text</th>
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
                <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label fw-bold">Gambar</label>
                            <input class="form-control" type="file" id="formFileMultiple" name="image">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Nama Siswa" name="nama_siswa"
                                value="{{ old('nama_siswa') }}">
                            <label for="nama_siswa">Nama Siswa</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" placeholder="Angkatan Awal"
                                        name="angkatan_awal" value="{{ old('angkatan_awal') }}">
                                    <label for="angkatan_awal">Angkatan Awal</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" placeholder="Angkatan Akhir"
                                        name="angkatan_akhir" value="{{ old('angkatan_akhir') }}">
                                    <label for="angkatan_akhir">Angkatan Akhir</label>
                                </div>
                            </div>
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

                        <div id="text-sebelumnya" class="form-text text-danger">Image sebelumnya</div>
                        <img src="" alt="image" id="image" width="100px" height="100px">

                        <div class="mb-3 mt-3">
                            <label for="formFileMultiple" class="form-label fw-bold">Gambar</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama_siswa" placeholder="Nama Siswa"
                                name="nama_siswa" value="{{ old('nama_siswa') }}">
                            <label for="nama_siswa">Nama Siswa</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="numeric" class="form-control" placeholder="Angkatan Awal"
                                        id="angkatan_awal" name="angkatan_awal" value="{{ old('angkatan_awal') }}">
                                    <label for="angkatan_awal">Angkatan Awal</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="numeric" class="form-control" placeholder="Angkatan Akhir"
                                        id="angkatan_akhir" name="angkatan_akhir" value="{{ old('angkatan_akhir') }}">
                                    <label for="angkatan_akhir">Angkatan Akhir</label>
                                </div>
                            </div>
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


    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function() {
            var urlData = "{{ route('alumni.index') }}";
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: urlData,
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                columns: [{
                        data: 'image',
                    },
                    {
                        data: 'nama_siswa',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'text',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'angkatan',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'created_at',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

            $(document).on('click', '.btn_edit', function() {
                $('#image').addClass('d-none');
                var id = $(this).attr('data-id')
                $.get("{{ route('alumni.index') }}" + '/' + id + '/edit', function(data) {
                    if (data.image != '') {
                        $('#image').show();
                        $('#text-sebelumnya').show();
                        $('#image').attr('src', data.image);
                    } else {
                        $('#image').hide();
                        $('#text-sebelumnya').hide();
                    }

                    $('#id').val(id);
                    $('#nama_siswa').val(data.nama_siswa);
                    $('#angkatan_awal').val(data.angkatan_awal);
                    $('#angkatan_akhir').val(data.angkatan_akhir);
                    $('#text').val(data.text);
                    $('#image').removeClass('d-none');
                    $('#form_edit').attr('action', "{{ route('alumni.index') }}" + '/' + id);

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
