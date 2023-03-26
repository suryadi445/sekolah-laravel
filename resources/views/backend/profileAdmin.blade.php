@extends('layouts.admin.admin')

@section('admin')
    <style>
        .img-cover {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400italic);

        blockquote {
            font-size: 1.4em;
            width: 60%;
            margin: 0px auto;
            font-family: Open Sans;
            font-style: italic;
            color: #555555;
            padding: 1.2em 20px 0.7em 50px;
            border-left: 8px solid #78C0A8;
            line-height: 1.6;
            position: relative;
            background: #f7f7f7;
        }

        blockquote::before {
            font-family: Arial;
            content: "\201C";
            color: #78C0A8;
            font-size: 4em;
            position: absolute;
            left: 10px;
            top: -10px;
        }

        blockquote::after {
            content: '';
        }

        blockquote span {
            display: block;
            color: #333333;
            font-style: normal;
            font-weight: bold;
            margin-top: 1em;
        }
    </style>


    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>Profile Admin</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card text-capitalize text-center border border-0">
                                <div style="width:100%; text-align:center">
                                    <img src="{{ $profile->image == '' ? url('images/default/avatar.png') : $profile->image }}"
                                        class="img-cover img-thumbnail">
                                    <input type="file" id="my_file" style="display: none;" />

                                </div>
                                <h3>{{ $profile->name ?? '-' }}</h3>
                                <h5>{{ $profile->email ?? '' }}</h5>
                                <h6 class="text-secondary">{{ $profile->no_hp ?? '-' }}</h6>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-outline-warning " id="editPorfile"
                                        title="Edit Profile" data-id={{ $id_user }}>
                                        <i class="fa-solid fa-pen text-dark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <blockquote>
                                {{ $kataPengantar->text }}
                                <span class="text-capitalize">{{ getUser($kataPengantar->user)->name }}</span>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/profile/updateAdmin/{{ $id_user }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" id="password">
                                    <small class="text-danger">
                                        Isi jika ingin merubah Password
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <label for="image" class="form-label">Foto</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#editPorfile').on('click', function() {

                var idUser = $(this).attr('data-id');

                $.ajax({
                    type: "GET",
                    url: "/profile/editAdmin/" + idUser,
                    dataType: "json",
                    success: function(response) {
                        $('#username').val(response.no_hp)
                        $('#email').val(response.email)
                    }
                });

                $('#modalEdit').modal('show')
            })
        });
    </script>
@endsection
