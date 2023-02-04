@extends('layouts.admin.admin')

@section('admin')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="offset-md-6 col-md-3">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelect">Jabatan</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelect">Proses</label>
                            </div>
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


            $(document).on('click', '.btn_edit', function() {
                $('#image').addClass('d-none');
                var id = $(this).attr('data-id')
                $.get("{{ route('banner.index') }}" + '/' + id + '/edit', function(
                    data) {
                    $('#image').attr('src', data.image);
                    $('#image').removeClass('d-none');
                    $('#kategori_edit').val(data.kategori);
                    $('#judul_edit').val(data.judul);
                    $('#text_edit').val(data.text);
                    $('#form_edit').attr('action', "{{ route('banner.index') }}" + '/' + id);

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
