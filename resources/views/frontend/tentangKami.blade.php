@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron', $jumbotron, $data)
    @include('components.toast')


    <style>
        .custom-file-button input[type=file] {
            margin-left: -2px !important;
        }

        .custom-file-button input[type=file]::-webkit-file-upload-button {
            display: none;
        }

        .custom-file-button input[type=file]::file-selector-button {
            display: none;
        }

        .custom-file-button:hover label {
            background-color: #dde0e3;
            cursor: pointer;
        }
    </style>

    <section id="history">
        <div class="container px-4 mt-5">
            <div class="row">
                <ul class="nav nav-tabs nav-fill" role="tablist" id="myTab">
                    <li class="nav-item "><a class="nav-link active" data-toggle="tab" href="#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#karir">Karir</a></li>
                </ul>

                <div class="tab-content">
                    <div id="about" class="tab-pane fade show active">
                        <div class="row mt-5">
                            <div class="col-sm-12">
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    <div class="col">
                                        <div class="card">
                                            <img src="{{ $profile->image ?? asset('/images/default/abc.jpg') }}"
                                                class="card-img-top w-100 h-50" alt="image">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Profile Kami</h5>
                                                <a href="/tentangKami/profile">
                                                    <p class="card-text">Lihat Detail</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card">
                                            <img src="{{ $sejarah->image ?? asset('/images/default/about.png') }}"
                                                class="card-img-top" alt="image">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Sejarah Kami</h5>
                                                <a href="/tentangKami/sejarah">
                                                    <p class="card-text">Lihat Detail</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="karir" class="tab-pane fade">
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="card shadow p-3 mb-5 pb-5 bg-body rounded">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h2 class="text-center">Bergabunglah Bersama Kami</h2>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-4 mt-3">
                                            <div class="form-floating">
                                                <select class="form-select" id="jenis_pekerjaan"
                                                    aria-label="Floating label select example">
                                                    <option value="" disabled selected>Pilih Jenis Pekerjaan</option>
                                                    @foreach ($jenis_jabatan as $item)
                                                        <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 mt-3 row_loker">
                                            @forelse($karir as $key => $kar)
                                                @if ($key == 0)
                                                    <div class="card p-3 text-justify">
                                                        <h2 class="text-capitalize">{{ $kar->judul }}</h2>
                                                        <h6 class="text-capitalize">Posisi : {{ $kar->jabatan }}</h6>
                                                        <h6 class="text-capitalize">Dedline : {{ $kar->deadline }}</h6>

                                                        <p>{{ $kar->persyaratan }}</p>

                                                        <a href="javascript:void(0)" data-id="{{ $kar->id }}"
                                                            class="kirim_cvRow">Lamar Sekarang</a>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="alert alert-warning" role="alert">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    Pekejaan Tidak Tersedia
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <div class="row mt-3 row_loker">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                @foreach ($karir as $key => $item)
                                                    @if ($key > 0)
                                                        <div class="col-sm-6">
                                                            <div class="card p-3 text-justify">
                                                                <h2 class="text-capitalize">{{ $item->judul }}</h2>
                                                                <h6 class="text-capitalize">Posisi :
                                                                    {{ $item->jabatan }}</h6>
                                                                <h6 class="text-capitalize">
                                                                    Deadline :
                                                                    {{ $item->deadline }}</h6>

                                                                <p>{{ $item->persyaratan }}</p>

                                                                <a href="javascript:void(0)" data-id="{{ $item->id }}"
                                                                    class="kirim_cvRow">Lamar
                                                                    Sekarang</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <span id="div_lokerDinamis"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mt-5">
                                        {!! $karir->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="peta">
        <div class="container px-4 mt-5">
            <div class="row">
                <div class="col-sm-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15863.145812678567!2d106.73525875!3d-6.2917732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f0092fae80c5%3A0x439cd2b52dc67b80!2sJurang%20Mangu!5e0!3m2!1sid!2sid!4v1671331966032!5m2!1sid!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="modal_cv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-uppercase me-2" id="title_modal"></h1>
                    ( <small class="" id="jabatan_modal"></small> )
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="/tentangKami/karir" method="POST" enctype="multipart/form-data" class="needs-validation"
                    id="formKarir" novalidate>
                    @csrf
                    <input type="hidden" id="jabatan" name="jabatan">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama"
                                required>
                            <label for="nama">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" name="no_hp" id="no_hp"
                                placeholder="No Handphone" required>
                            <label for="no_hp">No. Handphone</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                                placeholder="Tanggal Lahir" required>
                            <label for="tgl_lahir">Tanggal Lahir</label>
                        </div>

                        <div class="input-group custom-file-button">
                            <label class="input-group-text" for="cv">Upload CV</label>
                            <input type="file" accept="application/pdf" class="form-control" id="cv"
                                name="cv" required>
                        </div>
                        <small class="text-secondary">Format yg didukung: PDF (Max Size : 2,5 MB)</small>

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
        $(document).ready(function() {
            $(document).on('click', '.kirim_cvRow', function() {
                var idCareer = $(this).attr('data-id')
                $.ajax({
                    type: "GET",
                    url: "/tentangKami/getPosisi_row/" + idCareer,
                    success: function(response) {
                        $('#title_modal').text(response.judul)
                        $('#jabatan').val(response.jabatan)
                        $('#jabatan_modal').text(response.jabatan)
                    }
                });

                $('#modal_cv').modal('show');
            })

            $(document).on('click', '.kirim_cv', function() {
                var idCareer = $(this).attr('data-id')
                $('#jabatan').val(idCareer)
                $.ajax({
                    type: "GET",
                    url: "/tentangKami/getPosisi/" + idCareer,
                    success: function(response) {
                        $('#title_modal').text(response.judul)
                        $('#jabatan_modal').text(response.jabatan)
                    }
                });

                $('#modal_cv').modal('show');
            })

            $('#jenis_pekerjaan').change(function(e) {
                e.preventDefault();
                var value = $(this).find("option:selected").text();

                $('#div_lokerDinamis').html('')
                div_loker = '';

                $.ajax({
                    type: "GET",
                    url: "/tentangKami/getPosisi/" + value,
                    success: function(response) {
                        $('.row_loker').addClass('d-none')

                        for (var i = 0; i < response.length; i++) {
                            var div_loker = `<div class="card p-3 text-justify mt-3">
                                                <h2 class="text-capitalize">` + response[i].judul + `</h2>
                                                <h6 class="text-capitalize">Posisi : ` + response[i].jabatan + `</h6>
                                                <h6 class="text-capitalize">
                                                    Deadline : ` + response[i].deadline + `
                                                </h6>
                                                <p>
                                                ` + response[i].persyaratan + `    
                                                </p>
                                                <a href="javascript:void(0)" data-id="` + response[i].jabatan + `" class="kirim_cv">
                                                    Lamar Sekarang
                                                </a>
                                            </div>`;

                            $('#div_lokerDinamis').append(div_loker)
                        }
                    }
                });
            });
        });
    </script>
@endsection
