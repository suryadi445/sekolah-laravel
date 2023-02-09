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
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Tanggal Pendaftaran</th>
                                    <th scope="col">Tanggal Penutupan</th>
                                    <th scope="col">Informasi Pendaftaran</th>
                                    <th scope="col">Gelombang</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($registration))
                                    @foreach ($registration as $item)
                                        <tr>
                                            <td>{{ $item->thn_ajaran }}</td>
                                            <td>{{ $item->tgl_pendaftaran }}</td>
                                            <td>{{ $item->tgl_penutupan }}</td>
                                            <td>{{ $item->info_pendaftaran }}</td>
                                            <td>{{ $item->gelombang }}</td>
                                            <td>{{ getUser($item->user)->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-warning btn_edit"
                                                    data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#modal_edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    Edit
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('registration.destroy', $item->id) }}">
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


                                @if (count($registration) == 0)
                                    <td colspan="7">
                                        <span class="text-danger">Data Tidak Tersedia </span>
                                    </td>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {!! $registration->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <div class="form-floating">
                                    <select class="form-select" aria-label="Tahun Ajaran" name="thn_ajaran">
                                        <option value="{{ date('Y') . '-' . date('Y') + 1 }}" selected>
                                            {{ date('Y') . '-' . date('Y') + 1 }}</option>
                                    </select>
                                    <label for="thn_ajaran">Tahun Ajaran</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-floating">
                                    <select class="form-select" name="gelombang">
                                        <option value="" disabled selected>Pilih Gelombang</option>
                                        <option value="I (Satu)">I (Satu)</option>
                                        <option value="II (Dua)">II (Dua)</option>
                                        <option value="III (Tiga)">III (Tiga)</option>
                                        <option value="IV (Empat)">IV (Empat)</option>
                                        <option value="V (Lima)">V (Lima)</option>
                                    </select>
                                    <label for="gelombang">Gelombang</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" placeholder="Tanggal Pendaftaran"
                                        name="tgl_pendaftaran" value="{{ old('tgl_pendaftaran') }}">
                                    <label for="tgl_pendaftaran">Tanggal Pendaftaran</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" placeholder="Tanggal Penutupan"
                                        name="tgl_penutupan" value="{{ old('tgl_penutupan') }}">
                                    <label for="tgl_penutupan">Tanggal penutupan</label>
                                </div>
                            </div>
                        </div>
                        <textarea id="info_pendaftaran" name="info_pendaftaran" value="{{ old('info_pendaftaran') }}"></textarea>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data" id="form_edit">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 mt-2">
                                <div class="form-floating">
                                    <select class="form-select" id="thn_ajaran" aria-label="Tahun Ajaran"
                                        name="thn_ajaran">
                                        <option value="{{ date('Y') . '-' . date('Y') + 1 }}" selected>
                                            {{ date('Y') . '-' . date('Y') + 1 }}</option>
                                    </select>
                                    <label for="thn_ajaran">Tahun Ajaran</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-floating">
                                    <select class="form-select" id="gelombang" name="gelombang">
                                        <option value="" disabled selected>Pilih Gelombang</option>
                                        <option value="I (Satu)">I (Satu)</option>
                                        <option value="II (Dua)">II (Dua)</option>
                                        <option value="III (Tiga)">III (Tiga)</option>
                                        <option value="IV (Empat)">IV (Empat)</option>
                                        <option value="V (Lima)">V (Lima)</option>
                                    </select>
                                    <label for="gelombang">Gelombang</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" placeholder="Tanggal Pendaftaran"
                                        id="tgl_pendaftaran" name="tgl_pendaftaran"
                                        value="{{ old('tgl_pendaftaran') }}">
                                    <label for="tgl_pendaftaran">Tanggal Pendaftaran</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" placeholder="Tanggal Penutupan"
                                        id="tgl_penutupan" name="tgl_penutupan" value="{{ old('tgl_penutupan') }}">
                                    <label for="tgl_penutupan">Tanggal penutupan</label>
                                </div>
                            </div>
                        </div>
                        <textarea id="info_pendaftaran_edit" name="info_pendaftaran"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.20.1/standard-all/ckeditor.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            CKEDITOR.replace('info_pendaftaran', {
                extraPlugins: 'editorplaceholder',
                editorplaceholder: 'Catatan: 1. Khusus pendaftaran gelombang pertama gratis biaya formulir dan diskon 20% ',
                removeButtons: 'PasteFromWord'
            });

            CKEDITOR.replace('info_pendaftaran_edit');

        });
    </script>

    <script>
        $(function() {
            $(document).on('click', '.btn_edit', function() {
                var id = $(this).attr('data-id')
                $.get("{{ route('registration.index') }}" + '/' + id + '/edit', function(data) {
                    $('#id').val(id);
                    $('#thn_ajaran').val(data.thn_ajaran);
                    $('#gelombang').val(data.gelombang);
                    $('#tgl_pendaftaran').val(data.tgl_pendaftaran);
                    $('#tgl_penutupan').val(data.tgl_penutupan);
                    CKEDITOR.instances.info_pendaftaran_edit.setData(data.info_pendaftaran)
                    $('#form_edit').attr('action', "{{ route('registration.index') }}" + '/' + id);
                    return false;

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
