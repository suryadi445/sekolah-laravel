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
                                    <th scope="col">Tanggal Kegiatan</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Text</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($notice))
                                    @foreach ($notice as $item)
                                        <tr>
                                            <td>{{ tanggal_indo($item->tanggal) }}</td>
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
                                                <form method="POST" action="{{ route('notice.destroy', $item->id) }}">
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


                                @if (count($notice) == 0)
                                    <td colspan="6">
                                        <span class="text-danger">Data Tidak Tersedia </span>
                                    </td>
                                @endempty
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {!! $notice->links() !!}
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
            <form action="{{ route('notice.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" placeholder="tanggal" name="tanggal"
                            value="{{ old('tanggal') }}" required>
                        <label for="tanggal">Tanggal Acara</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Judul" name="judul"
                            value="{{ old('judul') }}" required>
                        <label for="judul">Judul Berita</label>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="text"
                            value="{{ old('text') }}" style="height: 100px" required></textarea>
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

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" placeholder="tanggal" name="tanggal"
                            id="tanggal" value="{{ old('tanggal') }}">
                        <label for="tanggal">Tanggal Acara</label>
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
            $.get("{{ route('notice.index') }}" + '/' + id + '/edit', function(data) {
                $('#id').val(id);
                $('#tanggal').val(data.tanggal);
                $('#text').val(data.text);
                $('#judul').val(data.judul);
                $('#form_edit').attr('action', "{{ route('notice.index') }}" + '/' + id);

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
