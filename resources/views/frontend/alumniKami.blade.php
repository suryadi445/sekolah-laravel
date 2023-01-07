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
                <div class="form-floating">
                    <select class="form-select select_angkatan" id="floatingSelect">
                        <option value="">Semua Angkatan</option>
                        @foreach ($angkatans as $ang)
                            <option value="{{ $ang->angkatan_awal }}"
                                {{ $angkatan == $ang->angkatan_awal ? 'selected' : '' }}>
                                {{ $ang->angkatan_awal }}
                            </option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Angkatan</label>
                </div>
            </div>
        </div>
        @if ($alumnis->count())
            <div class="row row-cols-1 row-cols-md-6 g-4">
                @foreach ($alumnis as $item)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ url($item->image) }}" class="card-img-top" alt="image">
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

    <script>
        $(document).ready(function() {
            $(document).on('change', '.select_angkatan', function() {
                var val = $(this).val();
                if (val == '') {
                    window.location.href = '/alumniKami';
                } else {
                    window.location.href = '/alumniKami?angkatan=' + val;
                }

            })
        });
    </script>
@endsection
