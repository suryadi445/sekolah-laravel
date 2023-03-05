@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table
                                    class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden">
                                    <thead class="bg-dark text-light">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th scope="col">Jenis Pembayaran</th>
                                                <th scope="col">Nama Pembayaran</th>
                                                <th scope="col">Nomor Rekaning/Merchant</th>
                                                <th scope="col">Pemilik Rekaning/Merchant</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @if (!empty($payment))
                                            @foreach ($payment as $item)
                                                <tr>

                                                    <td>{{ $item->jenis }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->nomor }}</td>
                                                    <td>{{ $item->pemilik }}</td>
                                                    <td>{{ getUser($item->user)->name ?? '' }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning btn_edit"
                                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Edit
                                                        </button>
                                                        <form method="POST"
                                                            action="{{ route('pembayaran.destroy', $item->id) }}">
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


                                        @if ($payment->count() == 0)
                                            <td colspan="10">
                                                <span class="text-danger">Data Tidak Tersedia </span>
                                            </td>
                                        @endif
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center">
                                    {!! $payment->links() !!}
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pembayaran.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <select class="form-select" name="jenis" aria-label="Floating label select example" required>
                                <option selected disabled value="">Pilih Jenis Pembayaran</option>
                                <option value="bank">Bank</option>
                                <option value="Uang Elektronik">Uang Elektronik</option>
                            </select>
                            <label for="jenis">Jenis Pembayaran</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama" required
                                placeholder="Nama Pembayaran">
                            <label for="floatingInput">Nama Pembayaran</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nomor" required
                                placeholder="Nomor Rekening/Merchant">
                            <label for="floatingInput">Nomor Rekening/Merchant</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="pemilik" required
                                placeholder="Pemilik Akun Rekening/Merchant">
                            <label for="floatingInput">Pemilik Akun Rekening/Merchant</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="form_edit" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="jenis" name="jenis"
                                aria-label="Floating label select example" required>
                                <option disabled value="">Pilih Jenis Pembayaran</option>
                                <option value="bank">Bank</option>
                                <option value="Uang Elektronik">Uang Elektronik</option>
                            </select>
                            <label for="jenis">Jenis Pembayaran</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nama" name="nama" required
                                placeholder="Nama Pembayaran">
                            <label for="floatingInput">Nama Pembayaran</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="nomor" name="nomor" required
                                placeholder="Nomor Rekening/Merchant">
                            <label for="floatingInput">Nomor Rekening/Merchant</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="pemilik" name="pemilik" required
                                placeholder="Pemilik Akun Rekening/Merchant">
                            <label for="floatingInput">Pemilik Akun Rekening/Merchant</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function() {

            $(document).on('click', '.btn_edit', function() {
                var id = $(this).attr('data-id')
                $.get("{{ route('pembayaran.index') }}" + '/' + id + '/edit', function(data) {
                    $('#id').val(id);
                    $('#jenis').val(data.jenis);
                    $('#nama').val(data.nama);
                    $('#nomor').val(data.nomor);
                    $('#pemilik').val(data.pemilik);
                    $('#form_edit').attr('action', "{{ route('pembayaran.index') }}" + '/' + id);

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
