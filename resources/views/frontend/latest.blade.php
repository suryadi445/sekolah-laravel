@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron', $latestNews[0])

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h1>Latest News </h1>
            </div>
        </div>

        <div class="row mb-3 mt-3 {{ $id != null ? 'd-none' : '' }}">
            <div class="offset-md-6 col-md-3 mt-2">
                <div class="form-floating">
                    <select class="form-select select_tahun" id="floatingSelect">
                        <option value="all">Semua</option>
                        <option {{ $tahun == date('Y') ? 'selected' : '' }} value="{{ date('Y') }}">
                            {{ date('Y') }}</option>
                        <option {{ $tahun == date('Y') - 1 ? 'selected' : '' }} value="{{ date('Y') - 1 }}">
                            {{ date('Y') - 1 }}</option>
                        <option {{ $tahun == date('Y') - 2 ? 'selected' : '' }} value="{{ date('Y') - 2 }}">
                            {{ date('Y') - 2 }}</option>
                        <option {{ $tahun == date('Y') - 3 ? 'selected' : '' }} value="{{ date('Y') - 3 }}">
                            {{ date('Y') - 3 }}</option>
                        <option {{ $tahun == date('Y') - 4 ? 'selected' : '' }} value="{{ date('Y') - 4 }}">
                            {{ date('Y') - 4 }}</option>
                        <option {{ $tahun == date('Y') - 5 ? 'selected' : '' }} value="{{ date('Y') - 5 }}">
                            {{ date('Y') - 5 }}</option>
                        <option {{ $tahun == date('Y') - 6 ? 'selected' : '' }} value="{{ date('Y') - 6 }}">
                            {{ date('Y') - 6 }}</option>
                        <option {{ $tahun == date('Y') - 7 ? 'selected' : '' }} value="{{ date('Y') - 7 }}">
                            {{ date('Y') - 7 }}</option>
                        <option {{ $tahun == date('Y') - 8 ? 'selected' : '' }} value="{{ date('Y') - 8 }}">
                            {{ date('Y') - 8 }}</option>
                        <option {{ $tahun == date('Y') - 9 ? 'selected' : '' }} value="{{ date('Y') - 9 }}">
                            {{ date('Y') - 9 }}</option>
                        <option {{ $tahun == date('Y') - 10 ? 'selected' : '' }} value="{{ date('Y') - 10 }}">
                            {{ date('Y') - 10 }}</option>
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
            <div class="col-md-12">
                <div class="card-group">
                    @if ($latestNews->count())
                        <div class="row justify-content-center">
                            @foreach ($latestNews as $news)
                                <div class="col-md-3 mt-5">
                                    <div class="card h-100">
                                        <img src="{{ $news->image }}" class="card-img-top" alt="image">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $news->judul }}</h5>
                                            <a href="" class="btn_text text-decoration-none"
                                                data-id="{{ $news->id }}">
                                                <p class="card-text ">{{ $news->text }}</p>
                                            </a>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Last updated
                                                {{ $news->created_at->diffForHumans() }}</small>
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
                @if (count($latestNews) > 1)
                    {!! $latestNews->links() !!}
                @endif
            </div>
        </div>
    </div>

    <div class="modal" id="modal_detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="judul"></h1>
                </div>
                <div class="modal-body text-center">
                    <p id="text_modal"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal_close btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.modal_close', function() {
                $('#modal_detail').modal('hide')
            })

            $(document).on('change', '.select_tahun', function() {
                let tahun = $(this).val()
                let bulan = $('.select_bulan').val()

                window.location.href = '/latest?tahun=' + tahun + '&bulan=' + bulan;
            })

            $(document).on('change', '.select_bulan', function() {
                let tahun = $('.select_tahun').val()
                let bulan = $(this).val()

                window.location.href = '/latest?tahun=' + tahun + '&bulan=' + bulan;
            })

            $(document).on('click', '.btn_text', function(e) {
                e.preventDefault()
                let id = $(this).attr('data-id')
                const myModal = new bootstrap.Modal(document.getElementById('modal_detail'))
                $.get('/latest/get_row/' + id, function(data) {
                    $('#judul').text(data.judul)
                    $('#text_modal').text(data.text)
                })
                myModal.show()
            })
        });
    </script>
@endsection
