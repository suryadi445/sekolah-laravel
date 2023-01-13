@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron', $jumbotron)

    <section id="history">
        <div class="container px-4 mt-5">
            <div class="row">
                <ul class="nav nav-pills nav-fill">
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
                                            <img src="..." class="card-img-top" alt="...">
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
                                            <img src="..." class="card-img-top" alt="...">
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
                        <h3>Menu 1</h3>
                        <p>Some content in menu 1.</p>
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
@endsection
