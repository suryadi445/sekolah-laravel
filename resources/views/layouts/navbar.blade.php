@php
    use App\Models\Settings;
    
    $settings = Settings::first();
    
@endphp

<nav class="navbar navbar-expand-lg bg-light fixed-top pl-2 mb-5">
    <div class="container">
        <a class="navbar-brand text-center logo" href="/">
            {{ $settings->nama_perusahaan ?? 'Sistem Sekolah' }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link {{ Request::is('/') ? 'dodgerblue' : '' }}" href="/">
                    Home
                </a>
                <a class="nav-link {{ Request::is('tentangKami') ? 'dodgerblue' : '' }}" href="/tentangKami">
                    About
                </a>
                <a class="nav-link {{ Request::is('source/teacher') ? 'dodgerblue' : '' }}" href="/source/teacher">
                    Guru
                </a>
                <a class="nav-link {{ Request::is('source/student') ? 'dodgerblue' : '' }}" href="/source/student">
                    Siswa
                </a>
                <a class="nav-link {{ Request::is('pengumuman') ? 'dodgerblue' : '' }}" href="/pengumuman">
                    Pengumuman
                </a>
                <a class="nav-link {{ Request::is('foto') ? 'dodgerblue' : '' }}" href="/foto">
                    Gallery
                </a>
                <a class="nav-link {{ Request::is('pendaftaran') ? 'dodgerblue' : '' }}" href="/pendaftaran">
                    Pendaftaran
                </a>
                {{-- <a class="nav-link" href="/login">Login</a> --}}
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('login') ? 'dodgerblue' : '' }}"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-capitalize" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>

<script>
    gsap.from(".logo", {
        rotateY: 720,
        duration: 3,
        opacity: 0,
        delay: 1
    });

    gsap.from("nav", {
        ease: "bounce.out(10.5, 0.1)",
        delay: 0.3,
        y: -100,
        duration: 2,
        opacity: 0
    });
</script>
