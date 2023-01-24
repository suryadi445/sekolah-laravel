@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron')

    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-12">
                <h1>PENGUMUMAN</h1>
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-sm-12">
                @foreach ($pengumuman as $item)
                    <div class="row mt-5">
                        <div class="col-sm-3 bg-success text-center">
                            <h1 style="font-size: 9em">
                                {{ date('d', strtotime($item->tanggal)) }}
                            </h1>
                            <h3 class="text-capitalize">
                                {{ bulan('m', strtotime($item->tanggal)) }}
                            </h3>
                            <h3>
                                {{ date('Y', strtotime($item->tanggal)) }}
                            </h3>
                        </div>
                        <div class="offset-sm-1 col-sm-8">
                            <h1 class="text-uppercase">{{ $item->judul }}</h1>
                            <p>{{ $item->text }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
