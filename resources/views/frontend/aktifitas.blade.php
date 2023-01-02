@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron')

    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <h1>Kegiatan Siswa</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-group">
                    <div class="row">
                        @if ($aktifitas->count())
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center mt-5">
                {!! $aktifitas->links() !!}
            </div>
        </div>
    </div>
@endsection
