@extends('layouts.landing')

@section('container')
    @include('layouts.jumbotron', $data)

    <div class="container mb-5">
        <section id="teacher">
            <div class="row text-center mt-5">
                <div class="col-sm-12">
                    <h1>
                        Daftar Guru di Sekolah Kami
                    </h1>
                </div>
            </div>

            <div class="row mt-5">
                <div class="offset-sm-8 col-md-4">
                    <div class="row">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="cari" id="cari"
                                    class="form-control shadow mb-3 bg-body rounded" placeholder="Cari Guru"
                                    value="{{ request('cari') }}" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button type="submit"
                                        class="input-group-text bg-primary text-light shadow mb-3 rounded"
                                        id="basic-addon2">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-center">
                        @foreach ($datas as $item)
                            <div class="col-sm-4 mt-5 justify-content-center d-flex">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ $item->image == '' ? asset('images/default/avatar.png') : $item->image }}"
                                        class="card-img-top" alt="image">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-capitalize">{{ $item->nama_guru . ' ' . $item->gelar }}
                                        </h5>
                                        <h6 class="card-text">NIP: {{ $item->nip }}</h6>
                                        <h6 class="card-text">Jabatan: {{ $item->jabatan }}</h6>
                                        <h6 class="card-text">Pendidikan Terakhir:
                                            <span class="text-uppercase">
                                                {{ $item->pendidikan_terakhir }}
                                            </span>
                                        </h6>
                                        <a href="javascript:void(0)" data-id="{{ $item->id }}"
                                            class="btn btn-primary btn_modal">Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-center mt-5">
                {!! $datas->links() !!}
            </div>
        </section>
    </div>

    <div class="modal fade" id="modal_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nama Guru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table text-capitalize">
                        <tbody>
                            <tr class="table-borderless">
                                <td>Jenis Kelamin</td>
                                <td id="jenis_kelamin"></td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td id="agama"></td>
                            </tr>
                            <tr>
                                <td>Pendidikan Terakhir</td>
                                <td id="pendidikan"></td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td id="studi"></td>
                            </tr>
                            <tr>
                                <td>Alumni Dari</td>
                                <td id="alumni"></td>
                            </tr>
                            <tr>
                                <td>Mulai Tugas</td>
                                <td id="tugas"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td id="email"></td>
                            </tr>
                            <tr>
                                <td>NUPTK</td>
                                <td id="nuptk"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn_modal', function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: "get_guru/" + id,
                    success: function(response) {
                        $('#exampleModalLabel').text(response.nama_guru)
                        $('#jenis_kelamin').text(response.nama_guru)
                        $('#jenis_kelamin').text(response.jenis_kelamin)
                        $('#agama').text(response.agama)
                        $('#pendidikan').text(response.pendidikan_terakhir)
                        $('#studi').text(response.program_studi)
                        $('#alumni').text(response.alumni_dari)
                        $('#tugas').text(response.mulai_tugas)
                        $('#email').text(response.email)
                        $('#nuptk').text(response.nuptk)
                        $('#modal_detail').modal('show');
                    }
                });
            })
        });
    </script>
@endsection
