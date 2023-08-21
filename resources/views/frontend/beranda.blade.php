@php
    $textWelcome = 'Selamat datang di website resmi sekolah kami! Dengan sukacita dan penuh kebanggaan, saya sebagai Kepala Sekolah mengucapkan selamat datang kepada seluruh siswa, orangtua, guru, karyawan, dan seluruh anggota komunitas sekolah kami.Website ini merupakan wadah interaktif yang kami persembahkan untuk memberikan informasi terkini mengenai segala hal tentang sekolah kami. Di sini, Anda akan menemukan beragam informasi seputar program akademik, kegiatan ekstrakurikuler, prestasi siswa, dan berita terbaru dari sekolah. Kami mengundang Anda semua untuk menjelajahi website ini dengan antusiasme. Jangan ragu untuk menghubungi kami apabila ada pertanyaan, saran, atau dukungan yang ingin Anda berikan. Keterbukaan komunikasi adalah kunci utama dalam meningkatkan mutu dan kemajuan sekolah kita. Terima kasih telah menjadi bagian dari perjalanan pendidikan di sekolah kami. Bersama, mari kita wujudkan masa depan yang gemilang bagi generasi penerus bangsa ini.';
    
    $textNews = 'Setiap informasi terkini adalah sebuah undangan untuk terus berpetualang dalam perjalanan menuju pengetahuan dan kemajuan diri. Jadilah seperti spons yang meresapi ilmu, perubahan, dan pengalaman baru dengan antusiasme tanpa batas. Dalam setiap peristiwa, ada potensi besar untuk mengukir prestasi dan meraih impian tertinggi. Jangan pernah takut beradaptasi, karena siswa tangguh adalah yang mampu menaklukkan dunia yang terus berubah dengan bijaksana dan penuh semangat.
    Semakin cepat kita memperoleh informasi, semakin luas pula wawasan kita. Oleh karena itu, sebagai siswa yang cerdas, janganlah engkau malas untuk selalu mengikuti perkembangan terkini. Pastikanlah selalu mengandalkan sumber informasi yang terpercaya dan sahih agar pengetahuanmu benar-benar berkualitas dan terus relevan dengan tuntutan zaman.';
    
    $kegiatan = 'Di setiap kegiatan siswa terdapat ruang untuk menggapai mimpi dan mewujudkan cita-cita. Dalam setiap langkah yang kau pilih, janganlah sekali pun engkau mengabaikan arti dari kesungguhan dan ketekunan. Hiasi perjalananmu dengan senyuman, karena ketulusan hati akan menumbuhkan kebaikan dan kemesraan di antara teman-temanmu. Ingatlah, bahwa kegiatan bukan sekadar rutinitas, tetapi simbol dari perjuangan tak kenal lelah menuju puncak kejayaan. Kau adalah penulis cerita hidupmu sendiri, dan kegiatan adalah bagian penting dari setiap bab dalam buku itu. Jadi, berani dan percayalah, dan biarkan kegiatanmu menerangi dunia dengan keunikan dan kebahagiaan yang hanya kau miliki.';
@endphp


@extends('layouts.landing')

@section('container')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <section id="carousel" class="pt-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-inner">
                @if (count($slideshow) > 0)
                    @foreach ($slideshow as $key => $slide)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ $slide->image }}" class="d-block w-100" alt="image">
                        </div>
                    @endforeach
                @else
                    <div class="carousel-item active">
                        <img src="{{ asset('/images/default/board.jpg') }}" class="d-block w-100" alt="image">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('/images/default/img.jpg') }}" class="d-block w-100" alt="image">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('/images/default/class.jpg') }}" class="d-block w-100" alt="image">
                    </div>
                @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <div class="container-fluid px-0">
        <section id="welcome" class="mt-3 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-8" data-aos="fade-right" data-aos-duration="1500">
                                <h1>Welcome</h1>
                                {{ $introduction->text ?? $textWelcome }}
                            </div>
                            <div class="col-sm-4" data-aos="fade-left" data-aos-duration="1500">
                                <img src="{{ $introduction->image ?? asset('/images/default/profiles.jpg') }}"
                                    class="rounded img-fluid img-thumbnail" alt="image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="berita" class="bg-light">
            <div class="container pt-3 pb-5">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="text-center" data-aos="zoom-in-up" data-aos-duration="1200">Berita Terkini</h1>
                    </div>
                </div>

                @if ($latestNews->count())
                    <div class="row mt-5">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4" data-aos="zoom-out-up" data-aos-duration="1500">
                                    <img src="{{ $latestNews[0]->image }}"
                                        class="d-block w-100 rounded img-fluid img-thumbnail" alt="image">
                                </div>
                                <div class="col-sm-8" data-aos="zoom-out-up" data-aos-delay="1000" data-aos-duration="1500">
                                    <p>
                                        {{ $latestNews[0]->created_at->isoFormat('dddd, D MMMM Y') }}
                                    </p>
                                    <p>
                                        {{ $latestNews[0]->text }}
                                    </p>
                                    <a href="/latest/{{ $latestNews[0]->id }}">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="row row-cols-1 row-cols-md-3 g-4">
                                @foreach ($latestNews->skip(1) as $news)
                                    <div class="col-md-3">
                                        <div class="card h-100">
                                            <img src="{{ $news->image }}" class="card-img-top" alt="image">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $news->judul }}</h5>
                                                <p class="card-text">{{ $news->text }}</p>
                                                <p class="text-end pt-3">
                                                    <a href="/latest/{{ $news->id }}">Baca
                                                        Selengkapnya</a>
                                                </p>

                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">Last updated
                                                    {{ $news->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 d-flex justify-content-center">
                        <a href="/latest" class="col-sm-3 btn btn-info">
                            <span>Berita Selengkapnya
                                <i class="fa-solid fa-right-long"></i>
                            </span>
                        </a>
                    </div>
                @else
                    <div class="row mt-5">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4" data-aos="zoom-out-up" data-aos-duration="1500">
                                    <img src="{{ asset('/images/default/info.jpg') }}"
                                        class="d-block w-100 rounded img-fluid img-thumbnail" alt="image">
                                </div>
                                <div class="col-sm-8" data-aos="zoom-out-up" data-aos-delay="1000"
                                    data-aos-duration="1500">
                                    <p>
                                        {{ $textNews }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <section id="kegiatan">
            <div class="container mt-3 mb-5">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class=" text-center" data-aos="zoom-in-up" data-aos-duration="1200">
                            Kegiatan Siswa</h1>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="row">
                            @if ($activity->count())
                                @foreach ($activity as $item)
                                    <div class="col-sm-6">
                                        <div class="card mb-3" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img src="{{ $item->image }}" class="img-fluid rounded-start h-100"
                                                        alt="image" data-aos="flip-left" data-aos-duration="2500">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body" data-aos="fade-zoom-in"
                                                        data-aos-duration="1500" data-aos-delay="1000">
                                                        <h5 class="card-title">
                                                            {{ $item->judul }}</h5>
                                                        <p class="card-text">
                                                            {{ $item->text }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small class="text-muted" data-aos="fade-zoom-in"
                                                        data-aos-duration="1500" data-aos-delay="1000">Last updated
                                                        {{ $item->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="{{ $activity->count() % 2 == 0 ? 'offset-sm-3 mt-5 ' : '' }}col-sm-6">
                                    <a href="/aktifitas" class="d-flex align-items-center justify-content-center h-100">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            @else
                                <div class="col-sm-6">
                                    <div class="card mb-3" style="min-width: 880px;">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="{{ asset('/images/default/school.jpg') }}"
                                                    class="img-fluid rounded-start h-100" alt="image"
                                                    data-aos="flip-left" data-aos-duration="2500">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body" data-aos="fade-zoom-in" data-aos-duration="1500"
                                                    data-aos-delay="1000">
                                                    <p class="card-text">
                                                        {{ $kegiatan }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="alumni" class="bg-light mt-5 pt-5">
            <div class="container pt-3 pb-5">

                <div class="row">
                    <div class="col-6">
                        <h1 class="mb-3" data-aos="zoom-in-up" data-aos-duration="1200">Alumni Kami </h1>
                    </div>
                    <div class="col-6 text-right">
                        <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button"
                            data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button"
                            data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-12">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner row w-100 mx-auto">
                                @if ($alumnis->count())
                                    @foreach ($alumnis as $key => $item)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 mb-3" data-aos="fade-right"
                                                    data-aos-duration="1500">
                                                    <div class="shadow p-3 mb-5 bg-body">
                                                        <img class="img-fluid" src="{{ $item->image }}"
                                                            style="width: 100%; height: 25vw; object-fit: contain;">
                                                    </div>
                                                </div>
                                                <div class="offset-lg-1 col-lg-6 col-md-12" data-aos="fade-left"
                                                    data-aos-duration="1500">
                                                    <div class="card text-center shadow mb-5 bg-body">
                                                        <div class="card-body">
                                                            <h4 class="card-title">{{ $item->nama_siswa }}
                                                            </h4>
                                                            <p class="card-text">{{ $item->text }}</p>
                                                        </div>
                                                        <div class="card-footer text-muted">
                                                            <span>
                                                                Tahun Ajaran :
                                                                {{ $item->angkatan_awal . ' - ' . $item->angkatan_akhir }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center">
                                                    <a href="/alumniKami" class="text-center">
                                                        Berita Selengkapnya
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 mb-3" data-aos="fade-right"
                                                data-aos-duration="1500">
                                                <div class="shadow p-3 mb-5 bg-body">
                                                    <img class="img-fluid"
                                                        src="{{ asset('/images/default/alumni.jpg') }}"
                                                        style="width: 100%; height: 25vw; object-fit: contain;">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 mb-3" data-aos="fade-right"
                                                data-aos-duration="1500">
                                                <div class="shadow p-3 mb-5 bg-body">
                                                    <img class="img-fluid"
                                                        src="{{ asset('/images/default/alumni2.jpg') }}"
                                                        style="width: 100%; height: 25vw; object-fit: contain;">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 mb-3" data-aos="fade-right"
                                                data-aos-duration="1500">
                                                <div class="shadow p-3 mb-5 bg-body">
                                                    <img class="img-fluid"
                                                        src="{{ asset('/images/default/alumni3.jpg') }}"
                                                        style="width: 100%; height: 25vw; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-12 mb-3" data-aos="fade-right"
                                                data-aos-duration="1500">
                                                <div class="shadow p-3 mb-5 bg-body">
                                                    <img class="img-fluid"
                                                        src="{{ asset('/images/default/student.jpg') }}"
                                                        style="width: 100%; height: 25vw; object-fit: contain;">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 mb-3" data-aos="fade-right"
                                                data-aos-duration="1500">
                                                <div class="shadow p-3 mb-5 bg-body">
                                                    <img class="img-fluid"
                                                        src="{{ asset('/images/default/students.jpg') }}"
                                                        style="width: 100%; height: 25vw; object-fit: contain;">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 mb-3" data-aos="fade-right"
                                                data-aos-duration="1500">
                                                <div class="shadow p-3 mb-5 bg-body">
                                                    <img class="img-fluid" src="{{ asset('/images/default/murid.jpg') }}"
                                                        style="width: 100%; height: 25vw; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script>
        AOS.init();
    </script>
@endsection
