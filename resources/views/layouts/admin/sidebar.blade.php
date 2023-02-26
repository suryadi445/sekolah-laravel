<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-1 sidebar-sticky pb-5">
                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>Super Admin</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('rekruitment') ? 'active' : '' }}" href="/rekruitment">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            <i class="fa-solid fa-id-card-clip"></i>
                            Rekruitment
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('sppSiswa') ? 'active' : '' }}" href="/sppSiswa">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            <i class="fa-solid fa-wallet"></i>
                            SPP Siswa
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}" href="/settings">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-gear"></i>
                            Pengaturan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('user') ? 'active' : '' }}" href="/user">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-users-gear"></i>
                            Users
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('slideshow') ? 'active' : '' }}" data-bs-toggle="collapse"
                            href="#collapseExample" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <span data-feather="file" class="align-text-bottom"></span>
                            <i class="fa-solid fa-database"></i>
                            Master Data
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class=""
                                style="list-style: none; margin-left: 0; padding-left: 1em; text-indent: 1.4em;">
                                <li class="pt-1 ">
                                    <a href="/mapel" class="text-decoration-none text-dark">
                                        Mata Pelajaran
                                    </a>
                                </li>
                                <li class="pt-2 ">
                                    <a href="/kelas" class="text-decoration-none text-dark">
                                        Kelas
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>Admin</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                            href="/dashboard">
                            <span data-feather="home" class="align-text-bottom"></span>
                            <i class="fa-solid fa-house"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('absensi') ? 'active' : '' }}" aria-current="page"
                            href="/absensi">
                            <span data-feather="home" class="align-text-bottom"></span>
                            <i class="fa-solid fa-users"></i>
                            Absensi Siswa
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('evaluation') ? 'active' : '' }}" aria-current="page"
                            href="/evaluation">
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
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('slideshow') ? 'active' : '' }}" data-bs-toggle="collapse"
                            href="#collapseExample" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <span data-feather="file" class="align-text-bottom"></span>
                            <i class="fa-solid fa-image"></i>
                            Slideshow
                            <i class="fa-solid fa-angle-down"></i>
                        </a>
                        <div class="collapse" id="collapseExample">
                            <ul class=""
                                style="list-style: none; margin-left: 0; padding-left: 1em; text-indent: 1.4em;">
                                <li class="pt-1 ">
                                    <a href="/slideshow" class="text-decoration-none text-dark">
                                        Slideshow Utama
                                    </a>
                                </li>
                                <li class="pt-2 ">
                                    <a href="/banner" class="text-decoration-none text-dark">
                                        Image Banner
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('introduction') ? 'active' : '' }}" href="/introduction">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            <i class="fa-solid fa-book-open"></i>
                            Kata Pengantar
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('latestNews') ? 'active' : '' }}" href="/latestNews">
                            <span data-feather="users" class="align-text-bottom"></span>
                            <i class="fa-regular fa-newspaper"></i>
                            Berita Terkini
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('activity') ? 'active' : '' }}" href="/activity">
                            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                            <i class="fa-solid fa-chalkboard-user"></i>
                            Kegiatan Siswa
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('alumni') ? 'active' : '' }}" href="/alumni">
                            <span data-feather="layers" class="align-text-bottom"></span>
                            <i class="fa-solid fa-graduation-cap"></i>
                            Alumni
                        </a>
                    </li>
                </ul>

                <h6
                    class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>Halaman Navigasi</span>
                    <a class="link-secondary" href="#" aria-label="Add a new report">
                        <span data-feather="plus-circle" class="align-text-bottom"></span>
                    </a>
                </h6>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-school"></i>
                            Tentang Kami
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('default') ? 'active' : '' }}" href="/default">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-gear"></i>
                            Default Tentang Kami
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('guru') ? 'active' : '' }}" href="/guru">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-person-chalkboard"></i>
                            Guru
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('siswa') ? 'active' : '' }}" href="/siswa">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-user-graduate"></i>
                            Siswa
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('notice') ? 'active' : '' }}" href="/notice">
                            <span data-feather="file-text" class="align-text-bottom"></span>
                            <i class="fa-solid fa-circle-info"></i>
                            Pengumuman
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('gallery') ? 'active' : '' }}" href="/gallery">
                            <span data-feather="shopping-cart" class="align-text-bottom"></span>
                            <i class="fa-solid fa-images"></i>
                            Gallery
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('registration') ? 'active' : '' }}" href="/registration">
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
