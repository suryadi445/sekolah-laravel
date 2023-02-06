@extends('layouts.admin.admin')

@section('admin')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="offset-md-6 col-md-3 mt-1">
                    <div class="form-floating">
                        <select class="form-select" id="pilih_jabatan" aria-label="Floating label select example">
                            <option selected value="all">Semua Jabatan</option>
                            @foreach ($jabatan as $item)
                                <option class="text-capitalize" value="{{ $item->jabatan }}"
                                    {{ request('jabatan') == $item->jabatan ? 'selected' : '' }}>{{ $item->jabatan }}
                                </option>
                            @endforeach
                        </select>
                        <label for="pilih_jabatan">Jabatan</label>
                    </div>
                </div>
                <div class="col-md-3 mt-1">
                    <div class="form-floating">
                        <select class="form-select" id="pilih_proses" aria-label="Floating label select example">
                            <option selected value="all">Semua Proses</option>
                            <option {{ request('proses') == '1' ? 'selected' : '' }} value="1">Proses
                            </option>
                            <option {{ request('proses') == '0' ? 'selected' : '' }} value="0">Belum
                                Diproses</option>
                        </select>
                        <label for="pilih_proses">Proses</label>
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
                                    <th scope="col">No</th>
                                    <th scope="col">Cv Pelamar</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Nama Pelamar</th>
                                    <th scope="col">No. Handphone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Umur</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($rekruitment))
                                    @foreach ($rekruitment as $key => $item)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>
                                                <a href="{{ $item->cv }}" class="text-decoration-none" download>
                                                    Download
                                                </a>
                                            </td>
                                            <td>{{ $item->jabatan }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>
                                                <a href="whatsapp://send?abid={{ $item->no_hp }}"
                                                    class="text-decoration-none">
                                                    {{ $item->no_hp }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="mailto: {{ $item->email }}" class="text-decoration-none">
                                                    {{ $item->email }}
                                                </a>
                                            </td>
                                            <td>{{ getUmur($item->tgl_lahir) }}</td>
                                            <td>
                                                <div>
                                                    <input class="form-check-input proses" type="checkbox"
                                                        title="Proses Kandidat"
                                                        value="{{ $item->proses == '0' ? '1' : '0' }}"
                                                        data-id="{{ $item->id }}"
                                                        {{ $item->proses == '1' ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif


                                @if (count($rekruitment) == 0)
                                    <td colspan="8">
                                        <span class="text-danger">Data Tidak Tersedia </span>
                                    </td>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {!! $rekruitment->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $(document).on('change', '.proses', function() {
                var id = $(this).attr('data-id')
                var value = $(this).val()

                $.ajax({
                    type: "POST",
                    url: "/rekruitment/prosesCV",
                    data: {
                        'id': id,
                        'value': value,
                        '_token': $('input[name=_token]').val(),
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            })


            $(document).on('change', '#pilih_jabatan', function() {
                var jabatan = $(this).val();
                var proses = $('#pilih_proses').val();

                window.location = "/rekruitment?jabatan=" + jabatan + '&proses=' + proses;
            })

            $(document).on('change', '#pilih_proses', function() {
                var proses = $(this).val();
                var jabatan = $('#pilih_jabatan').val();

                window.location = "/rekruitment?jabatan=" + jabatan + '&proses=' + proses;
            })
        });
    </script>
@endsection
