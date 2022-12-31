@extends('layouts.admin.admin')

@section('admin')
    @empty($introduction)
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
    @endempty

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">Gambar</th>
                            <th scope="col">Text</th>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">User</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($introduction))
                            <tr>
                                <td><img src="{{ $introduction->image }}" alt="image" width="100px"></td>
                                <td>{{ $introduction->text }}</td>
                                <td>{{ $introduction->created_at }}</td>
                                <td>{{ getUser($introduction->user)->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning btn_edit"
                                        data-id="{{ $introduction->id }}" data-bs-toggle="modal"
                                        data-bs-target="#modal_edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('introduction.destroy', $introduction->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger btn_delete mt-2">
                                            <i class="fa-solid fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif


                        @empty($introduction)
                            <td colspan="5">
                                <span class="text-danger">Data Tidak Tersedia </span>
                            </td>
                        @endempty
                    </tbody>
                </table>
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
                <form action="{{ route('introduction.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label fw-bold">Gambar</label>
                            <input class="form-control" type="file" id="formFileMultiple" name="image">
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

                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">

                        <div id="" class="form-text text-danger">Image sebelumnya</div>
                        <img src="" alt="image" id="image" width="100px" height="100px">

                        <div class="mb-3 mt-3">
                            <label for="formFileMultiple" class="form-label fw-bold">Gambar introduction</label>
                            <input class="form-control" type="file" id="image" name="image">
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
                $.get("{{ route('introduction.index') }}" + '/' + id + '/edit', function(data) {
                    console.log(data.text);
                    $('#image').attr('src', data.image);
                    $('#text').val(data.text);
                    $('#image').removeClass('d-none');
                    $('#form_edit').attr('action', "{{ route('introduction.store') }}");

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
