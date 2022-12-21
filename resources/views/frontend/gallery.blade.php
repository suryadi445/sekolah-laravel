@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron')

    <div class="container">
        <div class="row mt-5 text-center">
            <div class="col-sm-12">
                <h1>Gallery</h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card-group">
                    <div class="row">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="col-sm-4 px-0">
                                <div class="card">
                                    <img src="{{ asset('images/upload/map.jpg') }}" class="card-img-top" alt="image">
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 text-center">
            <div class="col-sm-12">
                <a href="#">Selengkapnya</a>
            </div>
        </div>

    </div>
@endsection
