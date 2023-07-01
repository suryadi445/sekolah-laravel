@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="min-height: 2.7em">
                    <div class="row">
                        <div class="offset-md-9 col-md-3 mt-3 mt-sm-0">
                            @empty($th_ajaran)
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#modal_add">
                                    <i class="fa-solid fa-plus"></i>
                                    Tambah Data
                                </button>
                            @endempty
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
                                                <th scope="col">Tahun Ajaran Awal</th>
                                                <th scope="col">Tahun Ajaran Akhir</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @if (!empty($th_ajaran))
                                            <tr>

                                                <td>{{ $th_ajaran->thn_ajaran_awal }}</td>
                                                <td>{{ $th_ajaran->thn_ajaran_akhir }}</td>
                                                <td>{{ $th_ajaran->keterangan ?? '-' }}</td>
                                                <td>{{ getUser($th_ajaran->user)->name ?? '' }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-warning btn_edit"
                                                        data-id="{{ $th_ajaran->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#modal_edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        Edit
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif


                                        @if (empty($th_ajaran))
                                            <td colspan="10">
                                                <span class="text-danger">Data Tidak Tersedia </span>
                                            </td>
                                        @endif
                                    </tbody>
                                </table>
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
                <form action="{{ route('th_ajaran.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="number" name="thn_ajaran_awal" class="form-control" id="thn_ajaran_awal"
                                        placeholder="Tahun Ajaran Awal" value="{{ date('Y') }}" required>
                                    <label for="thn_ajaran_awal">Tahun Ajaran Awal</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="number" name="thn_ajaran_akhir" class="form-control" id="thn_ajaran_akhir"
                                        placeholder="Tahun Ajaran Akhir" value="{{ date('Y') + 1 }}" required>
                                    <label for="thn_ajaran_akhir">Tahun Ajaran Akhir</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="keterangan" id="keterangan"></textarea>
                                    <label for="keterangan">Keterangan</label>
                                </div>
                            </div>
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
                        <div class="row">
                            <input type="hidden" id="id" name="id">
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="number" name="thn_ajaran_awal" class="form-control"
                                        id="thn_ajaran_awal_edit" placeholder="Tahun Ajaran Awal" required>
                                    <label for="thn_ajaran_awal">Tahun Ajaran Awal</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-3">
                                    <input type="number" name="thn_ajaran_akhir" class="form-control"
                                        id="thn_ajaran_akhir_edit" placeholder="Tahun Ajaran Akhir" required>
                                    <label for="thn_ajaran_akhir">Tahun Ajaran Akhir</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="keterangan" id="keterangan_edit"></textarea>
                                    <label for="keterangan">Keterangan</label>
                                </div>
                            </div>
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
                $.get("{{ route('th_ajaran.index') }}" + '/' + id + '/edit', function(data) {
                    console.log(data);
                    $('#id').val(id);
                    $('#thn_ajaran_awal_edit').val(data.thn_ajaran_awal);
                    $('#thn_ajaran_akhir_edit').val(data.thn_ajaran_akhir);
                    $('#keterangan_edit').val(data.keterangan);
                    $('#form_edit').attr('action', "{{ route('th_ajaran.index') }}" + '/' + id);

                })
            })
        });
    </script>
@endsection
