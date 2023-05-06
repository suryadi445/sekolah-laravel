@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 mt-1 mt-sm-0">
                            <div class="form-floating">
                                <select class="form-select" id="kelas" aria-label="Floating label select example">
                                    <option value="" selected>
                                        Semua Kelas
                                    </option>
                                    @foreach ($kelas as $item)
                                        <option
                                            {{ request('kelas') == $item->kelas . ' ' . $item->sub_kelas ? 'selected' : '' }}
                                            value="{{ $item->kelas . ' ' . $item->sub_kelas }}">
                                            {{ $item->kelas . ' ' . $item->sub_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="kelas">Pilih Kelas</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mt-1 mt-sm-0">
                            <div class="form-floating">
                                <select class="form-select" id="hari" aria-label="Floating label select example">
                                    <option selected value="">
                                        Semua Hari
                                    </option>
                                    <option {{ request('hari') == 'Senin' ? 'selected' : '' }} value="Senin">Senin
                                    </option>
                                    <option {{ request('hari') == 'Selasa' ? 'selected' : '' }} value="Selasa">
                                        Selasa
                                    </option>
                                    <option {{ request('hari') == 'Rabu' ? 'selected' : '' }} value="Rabu">Rabu
                                    </option>
                                    <option {{ request('hari') == 'Kamis' ? 'selected' : '' }} value="Kamis">Kamis
                                    </option>
                                    <option {{ request('hari') == 'Jumat' ? 'selected' : '' }} value="Jumat">Jumat
                                    </option>
                                    <option {{ request('hari') == 'Sabtu' ? 'selected' : '' }} value="Sabtu">Sabtu
                                    </option>
                                </select>
                                <label for="hari">Pilih Hari</label>
                            </div>
                        </div>
                        <div class="offset-md-3 col-md-3 mt-3 mt-sm-0">
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#modal_add">
                                <i class="fa-solid fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="/schedule/exportPdf/{{ request('kelas') . '/' . request('hari') }}" id="exportPdf"
                                    target="_blank" class="btn btn-success">
                                    <span class="me-1">Print PDF</span>
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="/schedule/exportExcel/{{ request('kelas') . '/' . request('hari') }}"
                                    id="exportExcel" target="_blank" class="btn btn-warning">
                                    <span class="me-1">Print Excel</span>
                                    <i class="fa-solid fa-file-excel"></i>
                                </a>
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
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Hari</th>
                                                <th scope="col">Jadwal Pelajaran</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @if (!empty($schedule))
                                            @foreach ($schedule as $item)
                                                <tr>
                                                    <td>{{ $item->kelas }}</td>
                                                    <td>{{ $item->hari }}</td>
                                                    <td>{{ getMapel($item->id_mapel) }}</td>
                                                    <td>{{ getUser($item->user)->name }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning btn_edit"
                                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Edit
                                                        </button>
                                                        <form method="POST"
                                                            action="{{ route('schedule.destroy', $item->id) }}">
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


                                        @if ($schedule->count() == 0)
                                            <td colspan="7">
                                                <span class="text-danger">Data Tidak Tersedia </span>
                                            </td>
                                        @endif
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $schedule->links() !!}
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
                <form action="{{ route('schedule.store') }}" method="POST" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Kelas</label>
                            <select class="form-select" name="kelas" required>
                                <option disabled selected value="">Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->kelas . ' ' . $item->sub_kelas }}">
                                        {{ $item->kelas . ' ' . $item->sub_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jadwal Hari</label>
                            <select class="form-select" name="hari" required>
                                <option selected disabled value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Mata Pelajaran</label>
                            <select class="form-select select2" name="mapel[]" id="mapel" multiple required>
                                @foreach ($mapels as $item)
                                    <option value="{{ $item->id }}">{{ $item->mata_pelajaran }}</option>
                                @endforeach
                            </select>
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
                <form action="" method="POST" enctype="multipart/form-data" id="form_edit"
                    class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <div class="mb-3">
                            <label for="" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas_edit" name="kelas" required>
                                <option disabled selected value="">Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->kelas . ' ' . $item->sub_kelas }}">
                                        {{ $item->kelas . ' ' . $item->sub_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jadwal Hari</label>
                            <select class="form-select" id="hari_edit" name="hari" required>
                                <option disabled value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Mata Pelajaran</label>
                            <select class="form-select select2" id="mapel_edit" name="mapel[]" multiple required>
                                @foreach ($mapels as $item)
                                    <option value="{{ $item->id }}">{{ $item->mata_pelajaran }}</option>
                                @endforeach
                            </select>
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

            $(document).on('change', '#kelas', function() {
                var kelas = $(this).val();
                var hari = $('#hari').val();
                window.location = "/schedule?kelas=" + kelas + '&hari=' + hari;
            })

            $(document).on('change', '#hari', function() {
                var hari = $(this).val();
                var kelas = $('#kelas').val();
                window.location = "/schedule?kelas=" + kelas + '&hari=' + hari;
            })

            $(document).on('click', '.btn_edit', function() {
                var id = $(this).attr('data-id')
                $.get("{{ route('schedule.index') }}" + '/' + id + '/edit', function(data) {
                    var id_mapel = JSON.parse("[" + data.id_mapel + "]");

                    $('#id').val(id);
                    $('#kelas_edit').val(data.kelas);
                    $('#hari_edit').val(data.hari);
                    $('#mapel_edit').val(id_mapel);
                    $('#mapel_edit').trigger('change');
                    $('#form_edit').attr('action', "{{ route('schedule.index') }}" + '/' + id);
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
