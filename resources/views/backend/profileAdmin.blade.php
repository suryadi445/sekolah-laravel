@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>Profile Admin</h6>
                </div>

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
                        background: #EDEDED;
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

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card text-capitalize text-center border border-0">
                                <div style="width:100%; text-align:center">
                                    <img src="{{ url('images/default/avatar.png') }}" class="img-cover img-thumbnail">
                                </div>
                                <h3>{{ $profile->name ?? '-' }}</h3>
                                <h5>{{ $profile->email ?? '' }}</h5>
                                <h6 class="text-secondary">{{ $profile->no_hp ?? '-' }}</h6>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/profile/updateGuru/{{ $id_user }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="no_hp" class="form-label">No Handphone</label>
                                    <input type="text" class="form-control" name="no_hp" id="no_hp">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" id="password">
                                    <small class="text-danger">Isi jika ingin merubah Password</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" class="form-control" name="nip" id="nip">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="number" class="form-control" name="nik" id="nik">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-2">
                                    <label for="image" class="form-label">Foto Guru</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea type="text" class="form-control" name="alamat" id="alamat" style="height: 100px"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <label for="moto_guru" class="form-label">Moto Guru</label>
                                    <textarea type="text" class="form-control" name="moto_guru" id="moto_guru" style="height: 100px"></textarea>
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

                var idGuru = $(this).attr('data-id');

                $.ajax({
                    type: "GET",
                    url: "/profile/editGuru/" + idGuru,
                    dataType: "json",
                    success: function(response) {
                        $('#no_hp').val(response.no_hp)
                        $('#username').val(response.username)
                        $('#email').val(response.email)
                        $('#nik').val(response.nik)
                        $('#nip').val(response.nip)
                        $('#alamat').val(response.alamat)
                        $('#moto_guru').val(response.moto_guru)
                    }
                });

                $('#exampleModal').modal('show')
            })
        });
    </script>
@endsection
