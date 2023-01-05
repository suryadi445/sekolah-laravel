@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron')

    <div class="container mb-5">
        <div class="row mb-3">
            <div class="col-md-12">
                <h1 class="text-center">Alumni Kami</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="offset-md-9 col-md-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected value="" disabled>Semua Angkatan</option>
                    @foreach ($angkatans as $angkatan)
                        <option value="{{ $angkatan->angkatan_awal }}">
                            {{ $angkatan->angkatan_awal }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        @if ($alumnis->count())
            <div class="row row-cols-1 row-cols-md-6 g-4">
                @foreach ($alumnis as $item)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $item->image }}" class="card-img-top" alt="image">
                            <div class="card-body">
                                <p class="card-text">{{ $item->nama_siswa }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="d-flex justify-content-center mt-5">
                    {!! $alumnis->links() !!}
                </div>
            </div>
        @endif

    </div>
@endsection
