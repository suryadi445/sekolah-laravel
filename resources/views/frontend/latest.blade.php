@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron')

    <div class="container">
        <div class="row mt-5 text-center">
            <div class="col-sm-12">
                <h1>Latest News</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-group">
                    <div class="row">
                        @foreach ($latestNews as $news)
                            <div class="col-md-3 mt-5">
                                <div class="card h-100">
                                    <img src="{{ $news->image }}" class="card-img-top" alt="image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $news->judul }}</h5>
                                        <p class="card-text">{{ $news->text }}</p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Last updated
                                            {{ $news->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-center mt-5">
                {!! $latestNews->links() !!}
            </div>
        </div>
    </div>
@endsection
