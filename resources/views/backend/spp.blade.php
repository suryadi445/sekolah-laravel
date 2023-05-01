@extends('layouts.admin.admin')

@section('admin')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group" role="group">
                                <a href="/sppSiswa/exportPdf" id="printPdf" target="_blank" class="btn btn-success">
                                    <span class="me-1">Print PDF</span>
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="/sppSiswa/exportExcel" id="printExcel" target="_blank" class="btn btn-warning">
                                    <span class="me-1">Print Excel</span>
                                    <i class="fa-solid fa-file-excel"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mt-3 mt-sm-0">
                            <select class="form-select" id="kelas">
                                <option selected value="">Semua Kelas</option>
                                @foreach (arrayKelas() as $item)
                                    <option value="{{ $item }}">Kelas {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mt-2 mt-sm-0">
                            <select class="form-select" id="subKelas">
                                <option selected value="">Semua Sub Kelas</option>
                                @foreach ($subKelas as $item)
                                    <option value="{{ $item->sub_kelas }}"> {{ $item->sub_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="p-3 mt-2 table-responsive">
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
            var urlData = "{{ route('sppSiswa.index') }}";
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: urlData,
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

            $('#kelas').change(function() {
                var linkPdf = '/sppSiswa/exportPdf';
                var linkExcel = '/sppSiswa/exportExcel';
                var kelas = $(this).val();
                var subKelas = $('#subKelas').val();

                // merubah url untuk print excel dan pdf
                $('#printPdf').attr('href', linkPdf + '/' + kelas + '/' + subKelas)
                $('#printExcel').attr('href', linkExcel + '/' + kelas + '/' + subKelas)

                //  merubah datatable menggunakan ajax
                var dataSrc = urlData + '?kelas=' + kelas + '&subKelas=' + subKelas;
                table.ajax.url(dataSrc).draw();
            })

            $('#subKelas').change(function() {
                var linkPdf = '/sppSiswa/exportPdf';
                var linkExcel = '/sppSiswa/exportExcel';
                var kelas = $('#kelas').val();
                var subKelas = $(this).val();

                // merubah url untuk print excel dan pdf
                $('#printPdf').attr('href', linkPdf + '/' + kelas + '/' + subKelas)
                $('#printExcel').attr('href', linkExcel + '/' + kelas + '/' + subKelas)


                var dataSrc = urlData + '?kelas=' + kelas + '&subKelas=' + subKelas;
                table.ajax.url(dataSrc).draw();
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
