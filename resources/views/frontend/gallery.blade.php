@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron', $data)

    <div class="container mb-5">
        <div class="row mt-5 text-center">
            <div class="col-sm-12">
                <h1>Gallery</h1>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card-group">
                    <div class="row">
                        @if (count($gallery))
                            @foreach ($gallery as $item)
                                <div class="col-sm-2 px-2 pt-2">
                                    <div class="card shadow mb-2 bg-body-tertiary rounded card_hov"
                                        data-id="{{ $item->id }}">
                                        <img src="{{ $item->image }}" class="card-img-top " alt="image">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @for ($i = 0; $i < 8; $i++)
                                <div class="col-sm-2 px-2 pt-2">
                                    <div class="card shadow mb-2 bg-body-tertiary rounded card_hov" data-id="">
                                        <img src="{{ asset('images/default/avatar.png') }}" class="card-img-top "
                                            alt="image">
                                    </div>
                                </div>
                            @endfor
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-center mt-5">
                {!! $gallery->links() !!}
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="image" id="image" class="w-100">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.card_hov', function() {
                let id = $(this).attr('data-id')
                $.ajax({
                    type: "GET",
                    url: "foto/get_image/" + id,
                    success: function(response) {
                        // console.log(response.image);
                        $('#image').attr('src', response.image)
                        $('#modal_image').modal('show')
                    }
                });
            })
        });
    </script>
@endsection
