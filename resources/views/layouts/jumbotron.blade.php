<div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-lg-6 col-sm-12">
            <img src="{{ $jumbotron->image ?? asset('images/default/info.jpg') }}" class="d-block w-100" alt="image"
                loading="lazy">
        </div>
        <div class="col-lg-6 text-center">
            {{-- anim-typewritter set in script --}}
            <h1 class="display-5 fw-bold lh-1 mb-3 anim-typewriter"></h1>
            <p class="lead">
                {{ $jumbotron->text ?? $text }}
            </p>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/TextPlugin.min.js"></script>

<script>
    gsap.registerPlugin(TextPlugin);

    gsap.to('.anim-typewriter', {
        duration: 2,
        text: "{{ $jumbotron->judul ?? $judul }}",
        ease: "none"
    });
</script>
