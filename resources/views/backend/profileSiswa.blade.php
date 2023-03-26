@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6>Profile Siswa</h6>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card text-capitalize text-center">
                                <img src="{{ $profile->image == '' ? url('images/default/avatar.png') : $profile->image }}"
                                    class="card-img-top" alt="...">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        {{ $profile->nama_siswa . ' ' . $profile->gelar }}
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
                                                        id="editPorfile" title="Edit Profile" data-id={{ $id_siswa }}>
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
                                                <li class="list-group-item">Kelas</li>
                                                <li class="list-group-item">Email</li>
                                                <li class="list-group-item">Nis</li>
                                                <li class="list-group-item">Nisn</li>
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
                                                    {{ $profile->kelas . ' ' . $profile->sub_kelas ?? '-' }}
                                                </li>
                                                <li class="list-group-item">
                                                    {{ $profile->email ?? '-' }}
                                                </li>
                                                <li class="list-group-item">
                                                    {{ $profile->nis ?? '-' }}</li>
                                                <li class="list-group-item">
                                                    {{ $profile->nisn ?? '-' }}
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
                            </div>
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
                <form action="/profile/updateSiswa/{{ $id_siswa }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username"
                                        @required(true)>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-2">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" id="password">
                                    <small class="text-danger">Isi jika ingin merubah Password</small>
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

                var idSiswa = $(this).attr('data-id');

                $.ajax({
                    type: "GET",
                    url: "/profile/editSiswa/" + idSiswa,
                    dataType: "json",
                    success: function(response) {
                        $('#username').val(response.no_hp)
                    }
                });

                $('#modalEdit').modal('show')
            })
        });
    </script>
@endsection
