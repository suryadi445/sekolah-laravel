@extends('layouts.admin.admin')

@section('admin')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3">
                            <select class="form-select" id="bulan">
                                <option disabled value="">Pilih Bulan</option>
                                <option {{ date('m') == 1 ? 'selected' : '' }} value="1">Januari</option>
                                <option {{ date('m') == 2 ? 'selected' : '' }} value="2">Februari</option>
                                <option {{ date('m') == 3 ? 'selected' : '' }} value="3">Maret</option>
                                <option {{ date('m') == 4 ? 'selected' : '' }} value="4">April</option>
                                <option {{ date('m') == 5 ? 'selected' : '' }} value="5">Mey</option>
                                <option {{ date('m') == 6 ? 'selected' : '' }} value="6">Juni</option>
                                <option {{ date('m') == 7 ? 'selected' : '' }} value="7">Juli</option>
                                <option {{ date('m') == 8 ? 'selected' : '' }} value="8">Agustus</option>
                                <option {{ date('m') == 9 ? 'selected' : '' }} value="9">September</option>
                                <option {{ date('m') == 10 ? 'selected' : '' }} value="10">Oktober</option>
                                <option {{ date('m') == 11 ? 'selected' : '' }} value="11">November</option>
                                <option {{ date('m') == 12 ? 'selected' : '' }} value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="bulan">
                                <option disabled value="">Pilih Tahun</option>
                                <option value="{{ date('Y') - 1 }}">
                                    {{ date('Y') - 1 }}</option>
                                <option selected value="{{ date('Y') }}">
                                    {{ date('Y') }}</option>
                                <option value="{{ date('Y') + 1 }}">
                                    {{ date('Y') + 1 }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="p-2 mt-2 table-responsive">
                    <table
                        class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden data-table"
                        width="100%">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">NIS</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Angkatan</th>
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

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet"> --}}
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
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('sppSiswa.index') }}",
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                columns: [{
                        data: 'nis',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'image',
                    },
                    {
                        data: 'nama_siswa',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'jenis_kelamin',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'tgl_lahir',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'kelas',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'thn_ajaran',
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
