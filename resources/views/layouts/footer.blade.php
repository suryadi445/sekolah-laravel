<section id="footer">
    <footer class="pt-5" style="background-color: #0a2540">
        <div class="container">
            <div class="footer-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row text-center text-light ">
                            <div class="col-sm-4 text-capitalize">
                                <img src="{{ $identity['logo'] ?? asset('/images/default/dikbud.png') }}" class=" mb-2"
                                    style="height: 130px; width: 130px;" alt="image">
                                <h4>
                                    @if ($identity['nama_perusahaan'] ?? '')
                                        {{ $identity['nama_perusahaan'] }}
                                    @endif
                                </h4>
                                <p>
                                    @if ($identity['alamat'] ?? '')
                                        <a href="http://maps.google.com/?q={{ $identity['latitude'] }},{{ $identity['longitude'] }}"
                                            target="_blank" class="text-decoration-none text-light"
                                            title="Lihat Alamat">
                                            <i class="fa-sharp fa-solid fa-location-dot me-1"></i>
                                            {{ $identity['alamat'] }}
                                        </a>
                                    @endif
                                </p>
                                <p>
                                    @if ($identity['email'] ?? '')
                                        <a href="mailto: {{ $identity['email'] }}" target="_blank"
                                            class="text-decoration-none text-light" title="Kirim Email">
                                            <i class="fa-solid fa-envelope me-1"></i>
                                            {{ $identity['email'] }}
                                        </a>
                                    @endif
                                </p>
                                <p>
                                    @if ($identity['no_telp'] ?? '')
                                        <a href="tel:{{ $identity['no_telp'] }}" target="_blank"
                                            class="text-decoration-none text-light" title="Telepon Kami">
                                            <i class="fa-solid fa-phone me-1"></i>
                                            {{ $identity['no_telp'] }}
                                        </a>
                                    @endif
                                </p>
                                <p>
                                    @if ($identity['no_hp'] ?? '')
                                        <a href="whatsapp://send?abid={{ $identity['no_hp'] }}" target="_blank"
                                            class="text-decoration-none text-light" title="Kirim Whatsapp">
                                            <i class="fa-brands fa-whatsapp me-1"></i>
                                            {{ $identity['no_hp'] }}
                                        </a>
                                    @endif

                                </p>
                            </div>
                            <div class="col-sm-4">
                                <h4>Tentang Kami</h4>
                                <p><a href="/tentangKami/sejarah" class="text-decoration-none">Sejarah</a></p>
                                <p><a href="/tentangKami/profile" class="text-decoration-none">Profil Kami</a></p>
                                <p><a href="/latest" class="text-decoration-none">Berita Terkini</a></p>
                                <p><a href="/aktifitas" class="text-decoration-none">Kegiatan Siswa</a></p>
                                <p><a href="/tentangKami#karir" class="text-decoration-none">Karir</a></p>
                            </div>
                            <div class="col-sm-4">
                                <h4>Ikuti Kami</h4>
                                @if (!empty($identity['facebook']))
                                    <p>
                                        <a href="{{ $identity['facebook'] }}" class="text-decoration-none"
                                            target="_blank">
                                            <i class="me-1 fa-brands fa-square-facebook"></i>
                                            Facebook
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="javascript:void(0)" class="text-decoration-none">
                                            <i class="me-1 fa-brands fa-square-facebook"></i>
                                            Facebook
                                        </a>
                                    </p>
                                @endif
                                @if (!empty($identity['ig']))
                                    <p>
                                        <a href="{{ $identity['ig'] }}" class="text-decoration-none" target="_blank">
                                            <i class="me-1 fa-brands fa-square-instagram"></i> Instagram
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="javascript:void(0)" class="text-decoration-none">
                                            <i class="me-1 fa-brands fa-square-instagram"></i> Instagram
                                        </a>
                                    </p>
                                @endif
                                @if (!empty($identity['twitter']))
                                    <p>
                                        <a href="{{ $identity['twitter'] }}" class="text-decoration-none"
                                            target="_blank">
                                            <i class="me-1 fa-brands fa-square-twitter"></i>
                                            Twitter
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="javascript:void(0)" class="text-decoration-none">
                                            <i class="me-1 fa-brands fa-square-twitter"></i>
                                            Twitter
                                        </a>
                                    </p>
                                @endif
                                @if (!empty($identity['youtube']))
                                    <p>
                                        <a href="{{ $identity['youtube'] }}" class="text-decoration-none"
                                            target="_blank">
                                            <i class="me-1 fa-brands fa-square-youtube"></i>
                                            Youtube
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="javascript:void(0)" class="text-decoration-none">
                                            <i class="me-1 fa-brands fa-square-youtube"></i>
                                            Youtube </a>
                                    </p>
                                @endif
                                @if (!empty($identity['linkedin']))
                                    <p>
                                        <a href="{{ $identity['linkedin'] }}" class="text-decoration-none"
                                            target="_blank">
                                            <i class="me-1 fa-brands fa-linkedin"></i>
                                            Linked In
                                        </a>
                                    </p>
                                @else
                                    <p>
                                        <a href="javascript:void(0)" class="text-decoration-none">
                                            <i class="me-1 fa-brands fa-linkedin"></i>
                                            Linked In
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-copyright mt-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-12">
                        <p class="copyright text-center text-light text-capitalize">&copy; 2022 - {{ date('Y') }}
                            {{ $identity['nama_perusahaan'] ?? 'Suryadi' }}
                            | All Rights Reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</section>
