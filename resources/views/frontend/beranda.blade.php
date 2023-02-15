@extends('layouts.landing')

@section('container')

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <section id="carousel" class="pt-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-inner">
                @foreach ($slideshow as $key => $slide)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ $slide->image }}" class="d-block w-100" alt="image">
                    </div>
                @endforeach
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
                                {{ $introduction->text ?? '' }}
                            </div>
                            <div class="col-sm-4" data-aos="fade-left" data-aos-duration="1500">
                                <img src="{{ $introduction->image ?? '' }}" class="rounded img-fluid img-thumbnail"
                                    alt="image">
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
                @endif


                <div class="row mt-5 d-flex justify-content-center">
                    <a href="/latest" class="col-sm-3 btn btn-info">
                        <span>Berita Selengkapnya
                            <i class="fa-solid fa-right-long"></i>
                        </span>
                    </a>
                </div>
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
                                                            <p class="card-text">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing elit. Minus quam voluptas earum porro dolore
                                                                perferendis, aperiam illum, sunt dolorem quod ex iusto
                                                                deserunt, nihil recusandae! Hic minus quisquam tempore eum!
                                                            </p>
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


                                        {{-- <div class="carousel-item">
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280" src="{{ $key }}">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Special title treatment</h4>
                                                            <p class="card-text">With supporting text below as a natural
                                                                lead-in to
                                                                additional content.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280"
                                                            src="https://images.unsplash.com/photo-1517760444937-f6397edcbbcd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=42b2d9ae6feb9c4ff98b9133addfb698">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Special title treatment</h4>
                                                            <p class="card-text">With supporting text below as a natural
                                                                lead-in to
                                                                additional content.</p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280"
                                                            src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3d2e8a2039c06dd26db977fe6ac6186a">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Special title treatment</h4>
                                                            <p class="card-text">With supporting text below as a natural
                                                                lead-in to
                                                                additional content.</p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="card">
                                                        <img class="img-fluid" alt="100%x280"
                                                            src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3d2e8a2039c06dd26db977fe6ac6186a">
                                                        <div class="card-body">
                                                            <h4 class="card-title">Special title treatment</h4>
                                                            <p class="card-text">With supporting text below as a natural
                                                                lead-in to
                                                                additional content.</p>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> --}}
                                    @endforeach
                                @endif

                                {{-- <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="https://images.unsplash.com/photo-1532781914607-2031eca2f00d?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=7c625ea379640da3ef2e24f20df7ce8d">
                                                <div class="card-body">
                                                    <h4 class="card-title">Special title treatment</h4>
                                                    <p class="card-text">With supporting text below as a natural lead-in to
                                                        additional content.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="https://images.unsplash.com/photo-1517760444937-f6397edcbbcd?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=42b2d9ae6feb9c4ff98b9133addfb698">
                                                <div class="card-body">
                                                    <h4 class="card-title">Special title treatment</h4>
                                                    <p class="card-text">With supporting text below as a natural lead-in to
                                                        additional content.</p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3d2e8a2039c06dd26db977fe6ac6186a">
                                                <div class="card-body">
                                                    <h4 class="card-title">Special title treatment</h4>
                                                    <p class="card-text">With supporting text below as a natural lead-in to
                                                        additional content.</p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280"
                                                    src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjMyMDc0fQ&amp;s=3d2e8a2039c06dd26db977fe6ac6186a">
                                                <div class="card-body">
                                                    <h4 class="card-title">Special title treatment</h4>
                                                    <p class="card-text">With supporting text below as a natural lead-in to
                                                        additional content.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
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
