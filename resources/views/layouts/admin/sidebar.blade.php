<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-1 sidebar-sticky pb-5">
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase {{ hakAksesView() }}">
                    <span>Super Admin</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>

                <ul class="nav flex-column">
                    <li class="nav-item   {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('rekruitment') ? 'active' : '' }}"
                            href="/rekruitment">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            <i class="fa-solid fa-id-card-clip"></i>
                            Rekruitment
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('career') ? 'active' : '' }}" href="/career">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            <i class="fa-solid fa-id-card"></i>
                            Karir
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('sppSiswa') ? 'active' : '' }}" href="/sppSiswa">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            <i class="fa-solid fa-wallet"></i>
                            SPP Siswa
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('settings') ? 'active' : '' }}" href="/settings">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-gear"></i>
                            Pengaturan
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('user') ? 'active' : '' }}" href="/user">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-users-gear"></i>
                            Users
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link has-child parent1 {{ Request::is('Master') ? 'active' : '' }}"
                            data-bs-toggle="collapse" href="#parent1" role="button" aria-expanded="false"
                            data-parent-id="master" aria-controls="parent1">
                            <span data-feather="file" class="align-text-bottom"></span>
                            <i class="fa-solid fa-database"></i>
                            Master Data
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <div class="collapse nav-child" id="parent1">
                            <ul class="nav-child"
                                style="list-style: none; margin-left: 0; padding-left: 1em; text-indent: 1.4em;">
                                <li class="pt-1 ">
                                    <a href="/th_ajaran"
                                        class="text-decoration-none {{ Request::is('th_ajaran') ? 'active' : 'text-dark' }}">
                                        Tahun Ajaran
                                    </a>
                                </li>
                                <li class="pt-1 ">
                                    <a href="/mapel"
                                        class="text-decoration-none {{ Request::is('mapel') ? 'active' : 'text-dark' }}">
                                        Mata Pelajaran
                                    </a>
                                </li>
                                <li class="pt-2">
                                    <a href="/schedule"
                                        class="text-decoration-none {{ Request::is('schedule') ? 'active' : 'text-dark' }}">
                                        Jadwal Pelajaran
                                    </a>
                                </li>
                                <li class="pt-2 ">
                                    <a href="/kelas"
                                        class="text-decoration-none {{ Request::is('kelas') ? 'active' : 'text-dark' }}">
                                        Kelas
                                    </a>
                                </li>
                                <li class="pt-2 ">
                                    <a href="/jabatan"
                                        class="text-decoration-none {{ Request::is('jabatan') ? 'active' : 'text-dark' }}">
                                        Jabatan
                                    </a>
                                </li>
                                <li class="pt-2 ">
                                    <a href="/pembayaran"
                                        class="text-decoration-none {{ Request::is('pembayaran') ? 'active' : 'text-dark' }}">
                                        Pembayaran
                                    </a>
                                </li>
                                <li class="pt-2 ">
                                    <a href="/promoted"
                                        class="text-decoration-none {{ Request::is('promoted') ? 'active' : 'text-dark' }}">
                                        Naik Kelas
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>{{ auth()->user()->name ?? '' }}</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>

                <ul class="nav flex-column">
                    <li class="nav-item ">
                        <a class="nav-link nav-single {{ Request::is('profile') ? 'active' : '' }}" aria-current="page"
                            href="/profile">
                            <span data-feather="home" class="align-text-bottom"></span>
                            <i class="fa-solid fa-user"></i> Profile
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link nav-single {{ Request::is('dashboard') ? 'active' : '' }}"
                            aria-current="page" href="/dashboard">
                            <span data-feather="home" class="align-text-bottom"></span>
                            <i class="fa-solid fa-house"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link nav-single {{ Request::is('absensi_guru') ? 'active' : '' }}"
                            aria-current="page" href="/absensi_guru">
                            <span data-feather="home" class="align-text-bottom"></span>
                            <i class="fa-solid fa-user-tie"></i>
                            Absensi Guru
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link nav-single {{ Request::is('absensi') ? 'active' : '' }}"
                            aria-current="page" href="/absensi">
                            <span data-feather="home" class="align-text-bottom"></span>
                            <i class="fa-solid fa-users"></i>
                            Absensi Siswa
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link nav-single {{ Request::is('evaluation') ? 'active' : '' }}"
                            aria-current="page" href="/evaluation">
                            <span data-feather="home" class="align-text-bottom"></span>
                            <i class="fa-solid fa-file-signature"></i>
                            Penilaian Siswa
                        </a>
                    </li>
                </ul>

                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>Halaman Home</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link has-child parent2" data-bs-toggle="collapse" data-parent-id="slideshow"
                            href="#parent2" role="button" aria-expanded="false" aria-controls="parent2">
                            <span data-feather="file" class="align-text-bottom"></span>
                            <i class="fa-solid fa-image"></i>
                            Slideshow
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <div class="collapse nav-child" id="parent2">
                            <ul class="nav-child"
                                style="list-style: none; margin-left: 0; padding-left: 1em; text-indent: 1.4em;">
                                <li class="pt-1 ">
                                    <a href="/slideshow"
                                        class="text-decoration-none {{ Request::is('slideshow') ? 'active' : 'text-dark' }}">
                                        Slideshow Utama
                                    </a>
                                </li>
                                <li class="pt-2 ">
                                    <a href="/banner"
                                        class="text-decoration-none {{ Request::is('banner') ? 'active' : 'text-dark' }}">
                                        Image Banner
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('introduction') ? 'active' : '' }}"
                            href="/introduction">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            <i class="fa-solid fa-book-open"></i>
                            Kata Pengantar
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('latestNews') ? 'active' : '' }}"
                            href="/latestNews">
                            <span data-feather="users" class="align-text-bottom"></span>
                            <i class="fa-regular fa-newspaper"></i>
                            Berita Terkini
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link nav-single {{ Request::is('activity') ? 'active' : '' }}"
                            href="/activity">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            <i class="fa-solid fa-chalkboard-user"></i>
                            Kegiatan Siswa
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link nav-single {{ Request::is('alumni') ? 'active' : '' }}" href="/alumni">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            <i class="fa-solid fa-graduation-cap"></i>
                            Alumni
                        </a>
                    </li>
                </ul>

                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase {{ hakAksesView() }}">
                    <span>Halaman Navigasi</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>

                <ul class="nav flex-column">
                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('about') ? 'active' : '' }}" href="/about">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-school"></i>
                            Tentang Kami
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('default') ? 'active' : '' }}" href="/default">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-gear"></i>
                            Default Tentang Kami
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('guru') ? 'active' : '' }}" href="/guru">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-person-chalkboard"></i>
                            Guru
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link nav-single {{ Request::is('siswa') ? 'active' : '' }}" href="/siswa">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-user-graduate"></i>
                            Siswa
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('notice') ? 'active' : '' }}" href="/notice">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-circle-info"></i>
                            Pengumuman
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('gallery') ? 'active' : '' }}" href="/gallery">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            <i class="fa-solid fa-images"></i>
                            Gallery
                        </a>
                    </li>

                    <li class="nav-item  {{ hakAksesView() }}">
                        <a class="nav-link nav-single {{ Request::is('registration') ? 'active' : '' }}"
                            href="/registration">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            <i class="fa-solid fa-id-card"></i>
                            Pendaftaran
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        @include('layouts.admin.main')
    </div>
</div>
