@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>Profile Guru</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card text-capitalize text-center">
                                <img src="{{ $profile->image ?? '' }}" class="card-img-top" alt="...">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        {{ $profile->nama_guru . ' ' . $profile->gelar }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ $profile->jenis_kelamin }}
                                    </li>
                                    <li class="list-group-item">
                                        {{ $profile->tempat_lahir . ', ' . $profile->tgl_lahir }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="offset-md-9 col-md-3">
                                                    <button type="button" class="btn btn-outline-warning float-end"
                                                        id="editPorfile" title="Edit Profile" data-id={{ $id_guru }}>
                                                        <i class="fa-solid fa-pen text-dark"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-capitalize">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Username</li>
                                                <li class="list-group-item">No Handphone</li>
                                                <li class="list-group-item">Email</li>
                                                <li class="list-group-item">Nik</li>
                                                <li class="list-group-item">Nip</li>
                                                <li class="list-group-item">Agama</li>
                                                <li class="list-group-item">Alamat</li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    {{ $profile->username ?? '-' }}
                                                </li>
                                                <li class="list-group-item">
                                                    {{ $profile->no_hp ?? '-' }}
                                                </li>
                                                <li class="list-group-item">
                                                    {{ $profile->email ?? '-' }}
                                                </li>
                                                <li class="list-group-item">
                                                    {{ $profile->nik ?? '-' }}</li>
                                                <li class="list-group-item">
                                                    {{ $profile->nip ?? '-' }}
                                                </li>
                                                <li class="list-group-item">
                                                    {{ $profile->agama ?? '-' }}
                                                </li>
                                                <li class="list-group-item">
                                                    {{ $profile->alamat }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <p class="card-text">
                                        {{ $profile->moto_guru == '' ? 'Moto Guru' : $profile->moto_guru }}
                                    </p>
                                </div>
                            </div>
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
                <form action="/profile/updateGuru/{{ $id_guru }}" method="POST" enctype="multipart/form-data">
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
