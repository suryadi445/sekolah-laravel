@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron')

    <div class="container">
        <section id="teacher">
            <div class="row text-center mt-5">
                <div class="col-sm-12">
                    <h1>
                        Daftar Guru di Sekolah Kami
                    </h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="row text-center">
                        <div class="col-sm-4">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/upload/image.png') }}" class="card-img-top" alt="image">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Nama Guru</h5>
                                    <h6 class="card-text">Jabatan Guru</h6>
                                    <h6 class="card-text">Pendidikan Terakhir</h6>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/upload/image.png') }}" class="card-img-top" alt="image">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Nama Guru</h5>
                                    <h6 class="card-text">Jabatan Guru</h6>
                                    <h6 class="card-text">Pendidikan</h6>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/upload/image.png') }}" class="card-img-top" alt="image">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Nama Guru</h5>
                                    <h6 class="card-text">Jabatan Guru</h6>
                                    <h6 class="card-text">Pendidikan</h6>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
