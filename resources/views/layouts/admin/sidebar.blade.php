 <div class="container-fluid">
     <div class="row">
         <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
             <div class="position-sticky pt-3 sidebar-sticky">
                 <ul class="nav flex-column">
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                             href="#">
                             <span data-feather="home" class="align-text-bottom"></span>
                             Dashboard
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('slideshow') ? 'active' : '' }}" href="/slideshow">
                             <span data-feather="file" class="align-text-bottom"></span>
                             Slideshow
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('introduction') ? 'active' : '' }}" href="/introduction">
                             <span data-feather="shopping-cart" class="align-text-bottom"></span>
                             Kata Pengantar
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('latestNews') ? 'active' : '' }}" href="/latestNews">
                             <span data-feather="users" class="align-text-bottom"></span>
                             Berita Terkini
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('activity') ? 'active' : '' }}" href="/activity">
                             <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                             Kegiatan Siswa
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('alumni') ? 'active' : '' }}" href="/alumni">
                             <span data-feather="layers" class="align-text-bottom"></span>
                             Alumni
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('footer') ? 'active' : '' }}" href="#">
                             <span data-feather="layers" class="align-text-bottom"></span>
                             Footer
                         </a>
                     </li>
                 </ul>

                 <h6
                     class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                     <span>Saved reports</span>
                     <a class="link-secondary" href="#" aria-label="Add a new report">
                         <span data-feather="plus-circle" class="align-text-bottom"></span>
                     </a>
                 </h6>
                 <ul class="nav flex-column mb-2">
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">
                             <span data-feather="file-text" class="align-text-bottom"></span>
                             About
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('siswa') ? 'active' : '' }}" href="#">
                             <span data-feather="file-text" class="align-text-bottom"></span>
                             Siswa
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('guru') ? 'active' : '' }}" href="#">
                             <span data-feather="file-text" class="align-text-bottom"></span>
                             Guru
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ Request::is('setting') ? 'active' : '' }}" href="/settings">
                             <span data-feather="file-text" class="align-text-bottom"></span>
                             Pengaturan
                         </a>
                     </li>
                 </ul>
             </div>
         </nav>

         @include('layouts.admin.main')
     </div>
 </div>
