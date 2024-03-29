@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/kelas/exportPdf" target="_blank" class="btn btn-success">
                                    <span class="me-1">Print PDF</span>
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="/kelas/exportExcel" target="_blank" class="btn btn-warning">
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
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Sub Kelas</th>
                                                <th scope="col">Wali Kelas</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Tanggal Dibuat</th>
                                                @if (userLogin()->id_group == 1 || userLogin()->id_group == 2)
                                                    <th scope="col">Biaya SPP</th>
                                                @endif
                                                <th scope="col">User</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @if (!empty($kelas))
                                            @foreach ($kelas as $item)
                                                <tr>

                                                    <td>{{ $item->kelas }}</td>
                                                    <td>{{ $item->sub_kelas }}</td>
                                                    <td>{{ $item->nama_guru }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    @if (userLogin()->id_group == 1 || userLogin()->id_group == 2)
                                                        <td>{{ 'Rp. ' . rupiah($item->biaya_spp) }}</td>
                                                    @endif
                                                    <td>{{ getUser($item->user)->name ?? '' }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning btn_edit"
                                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Edit
                                                        </button>
                                                        <form method="POST"
                                                            action="{{ route('kelas.destroy', $item->id) }}">
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


                                        @if ($kelas->count() == 0)
                                            <td colspan="10">
                                                <span class="text-danger">Data Tidak Tersedia </span>
                                            </td>
                                        @endif
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $kelas->links() !!}
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
                <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        @if (userLogin()->id_group == 1 || userLogin()->id_group == 2)
                            <div class="form-floating mt-3">
                                <input type="number" class="form-control" name="biaya_spp" placeholder="Biaya SPP"
                                    value="{{ old('biaya_spp') }}" required>
                                <label for="biaya_spp">
                                    Biaya Spp
                                    <i class="text-danger">*</i>
                                </label>
                            </div>
                        @endif
                        <div class="form-floating mt-3">
                            <select class="form-select" name="kelas" required>
                                <option selected disabled value="">Pilih Kelas</option>
                                @if (arrayKelas())
                                    @foreach (arrayKelas() as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <label for="floatingSelect">Kelas
                                <i class="text-danger">*</i>
                            </label>
                        </div>
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" name="sub_kelas" value="{{ old('sub_kelas') }}"
                                placeholder="Sub Kelas" required>
                            <label for="sub_kelas">Sub Kelas
                                <i class="text-danger">*</i>
                            </label>
                        </div>
                        <div class="form-floating mt-3">
                            <select class="form-select" name="id_guru" required>
                                <option selected disabled value="">Pilih Guru</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}">{{ ucwords($item->nama_guru) }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Wali Kelas
                                <i class="text-danger">*</i>
                            </label>
                        </div>
                        <div class="form-floating mt-3">
                            <textarea class="form-control" placeholder="Leave a comment here" name="keterangan" style="height: 100px">{{ old('keterangan') }}</textarea>
                            <label for="keterangan">Keterangan
                            </label>
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
                        <input type="hidden" name="id" id="id">
                        @if (userLogin()->id_group == 1 || userLogin()->id_group == 2)
                            <div class="form-floating mt-3">
                                <input type="text" class="form-control" placeholder="Leave a comment here"
                                    name="biaya_spp" id="biaya_spp" value="{{ old('biaya_spp') }}">
                                <label for="biaya_spp">Biaya Spp</label>
                            </div>
                        @endif
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" placeholder="Leave a comment here" name="kelas"
                                id="kelas" value="{{ old('kelas') }}">
                            <label for="kelas">Kelas</label>
                        </div>
                        <div class="form-floating mt-3">
                            <input type="text" class="form-control" placeholder="Leave a comment here"
                                name="sub_kelas" id="sub_kelas" value="{{ old('sub_kelas') }}">
                            <label for="sub_kelas">Sub Kelas</label>
                        </div>
                        <div class="form-floating mt-3">
                            <select class="form-select" id="id_guru" name="id_guru">
                                <option selected disabled value="">Pilih Guru</option>
                                @foreach ($guru as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_guru }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Wali Kelas</label>
                        </div>
                        <div class="form-floating mt-3">
                            <textarea class="form-control" placeholder="Leave a comment here" name="keterangan" id="keterangan"
                                style="height: 100px">{{ old('keterangan') }}</textarea>
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
            $(document).on('click', '.btn_edit', function() {
                var id = $(this).attr('data-id')
                $.get("{{ route('kelas.index') }}" + '/' + id + '/edit', function(data) {
                    $('#id').val(id);
                    $('#biaya_spp').val(Math.round(data.biaya_spp));
                    $('#kelas').val(data.kelas);
                    $('#sub_kelas').val(data.sub_kelas);
                    $('#id_guru').val(data.id_guru);
                    $('#keterangan').val(data.keterangan);
                    $('#form_edit').attr('action', "{{ route('kelas.index') }}" + '/' + id);

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
