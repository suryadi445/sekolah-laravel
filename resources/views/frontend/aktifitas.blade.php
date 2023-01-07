@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron')

    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <h1>Kegiatan Siswa</h1>
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <div class="offset-md-6 col-md-3 mt-2">
                <div class="form-floating">
                    <select class="form-select select_tahun" id="floatingSelect">
                        <option value="all">Semua Tahun</option>
                        @if ($years->count())
                            @foreach ($years as $ang)
                                <option value="{{ date('Y', strtotime($ang->created_at)) }}"
                                    {{ $tahun == date('Y', strtotime($ang->created_at)) ? 'selected' : '' }}>
                                    {{ date('Y', strtotime($ang->created_at)) }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    <label for="floatingSelect">Tahun</label>
                </div>
            </div>
            <div class="col-md-3 mt-2">
                <div class="form-floating">
                    <select class="form-select select_bulan" id="floatingSelect">
                        <option value="all">Semua</option>
                        <option {{ $bulan == 1 ? 'selected' : '' }} value="01">Januari</option>
                        <option {{ $bulan == 2 ? 'selected' : '' }} value="02">Februari</option>
                        <option {{ $bulan == 3 ? 'selected' : '' }} value="03">Maret</option>
                        <option {{ $bulan == 4 ? 'selected' : '' }} value="04">April</option>
                        <option {{ $bulan == 5 ? 'selected' : '' }} value="05">May</option>
                        <option {{ $bulan == 6 ? 'selected' : '' }} value="06">Juni</option>
                        <option {{ $bulan == 7 ? 'selected' : '' }} value="07">Juli</option>
                        <option {{ $bulan == 8 ? 'selected' : '' }} value="08">Agustus</option>
                        <option {{ $bulan == 9 ? 'selected' : '' }} value="09">September</option>
                        <option {{ $bulan == 10 ? 'selected' : '' }} value="10">Oktober</option>
                        <option {{ $bulan == 11 ? 'selected' : '' }} value="11">November</option>
                        <option {{ $bulan == 12 ? 'selected' : '' }} value="12">Desember</option>
                    </select>
                    <label for="floatingSelect">Bulan</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-group">
                    @if ($aktifitas->count())
                        <div class="row">
                            @foreach ($aktifitas as $item)
                                <div class="col-md-3 mt-5">
                                    <div class="card h-100">
                                        <img src="{{ $item->image }}" class="card-img-top" alt="image">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->judul }}</h5>
                                            <p class="card-text">{{ $item->text }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">
                                                Last updated
                                                {{ $item->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning col-md-12" role="alert">
                            <i class="fa-solid fa-circle-info"></i>
                            <span class="ml-2">Data Tidak Tersedia</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center mt-5">
                {!! $aktifitas->links() !!}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('change', '.select_tahun', function() {
                let tahun = $(this).val()
                let bulan = $('.select_bulan').val()

                window.location.href = '/aktifitas?tahun=' + tahun + '&bulan=' + bulan;
            })

            $(document).on('change', '.select_bulan', function() {
                let tahun = $('.select_tahun').val()
                let bulan = $(this).val()

                window.location.href = '/aktifitas?tahun=' + tahun + '&bulan=' + bulan;
            })
        });
    </script>
@endsection
