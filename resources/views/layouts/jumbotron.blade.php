<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-lg-6 col-sm-12">
            <img src="{{ $jumbotron->image ?? asset('images/default/landscape.png') }}" class="d-block w-100"
                alt="image" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold lh-1 mb-3">{{ $jumbotron->judul ?? 'Judul' }}</h1>
            <p class="lead">
                {{ $jumbotron->text ?? 'Lorem ipsum,' }}
            </p>
        </div>
    </div>
</div>
