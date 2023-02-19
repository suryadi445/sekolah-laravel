@extends('layouts.admin.admin')

@section('admin')
    <div class="card">
        @if ($settings)
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                @if (!empty($settings->logo))
                                    <img src="{{ $settings->logo }}" alt="image" width="100px">
                                @endif
                            </div>
                            <div class="offset-md-6 col-md-3">
                                <button type="button" class="btn btn-info float-end text-light" data-bs-toggle="modal"
                                    data-bs-target="#modal_add">
                                    <i class="fa-solid fa-plus"></i>
                                    Social Media
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table
                            class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col" width="20%">Data</th>
                                    <th scope="col" width="70%">Isi</th>
                                    <th scope="col" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="formFile" class="col-form-label">Logo Sekolah</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input class="form-control text-danger hidden" type="file" id="formFile"
                                                    name="logo" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="tipe_sekolah" class="col-form-label">Tipe Sekolah</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <select class="form-select text-danger" id="tipe_sekolah"
                                                    name="tipe_sekolah" required>
                                                    <option {{ ($settings->tipe_sekolah ?? '') == '' ? 'selected' : '' }}
                                                        value="" disabled selected>Pilih Tipe Sekolah</option>
                                                    <option
                                                        {{ ($settings->tipe_sekolah ?? '') == 'Pra Sekolah' ? 'selected' : '' }}
                                                        value="Pra Sekolah">Pra
                                                        Sekolah</option>
                                                    <option {{ ($settings->tipe_sekolah ?? '') == 'SD' ? 'selected' : '' }}
                                                        value="SD">Sekolah Dasar
                                                    </option>
                                                    <option {{ ($settings->tipe_sekolah ?? '') == 'SMP' ? 'selected' : '' }}
                                                        value="SMP">Sekolah
                                                        Menengah Pertama
                                                    </option>
                                                    <option {{ ($settings->tipe_sekolah ?? '') == 'SMA' ? 'selected' : '' }}
                                                        value="SMA">Sekolah
                                                        Mengah Atas</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="nama_perusahaan" class="col-form-label">Nama Sekolah</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input Nama Sekolah" id="nama_perusahaan"
                                                    class="form-control text-danger" name="nama_perusahaan"
                                                    value="{{ $settings->nama_perusahaan ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="no_hp" class="col-form-label">No. Handphone</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="number" placeholder="Input No. Handphone" name="no_hp"
                                                    id="no_hp" class="form-control text-danger"
                                                    value="{{ $settings->no_hp ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="no_telp" class="col-form-label">No. Telepon</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="number" placeholder="Input No. Telepon" id="no_telp"
                                                    name="no_telp" class="form-control text-danger"
                                                    value="{{ $settings->no_telp ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="alamat" class="col-form-label">Alamat</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input Alamat" id="alamat"
                                                    class="form-control text-danger" name="alamat"
                                                    value="{{ $settings->alamat ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="latitude" class="col-form-label">latitude</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input latitude" id="latitude"
                                                    class="form-control text-danger" name="latitude"
                                                    value="{{ $settings->latitude ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="longitude" class="col-form-label">longitude</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input longitude" id="longitude"
                                                    class="form-control text-danger" name="longitude"
                                                    value="{{ $settings->longitude ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="email" class="col-form-label">Email</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="email" placeholder="Input Email" id="email"
                                                    class="form-control text-danger" name="email"
                                                    value="{{ $settings->email ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="visi" class="col-form-label">Visi</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input Visi" id="visi"
                                                    class="form-control text-danger" name="visi"
                                                    value="{{ $settings->visi ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="misi" class="col-form-label">Misi</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input Misi" id="misi"
                                                    class="form-control text-danger" name="misi"
                                                    value="{{ $settings->misi ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="slogan" class="col-form-label">Slogan</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input Slogan" id="slogan"
                                                    class="form-control text-danger" name="slogan"
                                                    value="{{ $settings->slogan ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="npsn" class="col-form-label">NPSN</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input NPSN" id="npsn"
                                                    class="form-control text-danger" name="npsn"
                                                    value="{{ $settings->npsn ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="akreditasi" class="col-form-label">Akreditasi</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input Akreditasi" id="akreditasi"
                                                    class="form-control text-danger" name="akreditasi"
                                                    value="{{ $settings->akreditasi ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                                <tr>
                                    <form action="{{ route('settings.update', 1) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <div class="col-auto">
                                                <label for="pimpinan" class="col-form-label">Kepala Sekolah</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <input type="text" placeholder="Input Kepala Sekolah" id="pimpinan"
                                                    class="form-control text-danger" name="pimpinan"
                                                    value="{{ $settings->pimpinan ?? '' }}" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-auto">
                                                <button class="btn btn-sm btn-warning fw-bold" type="submit">
                                                    Update
                                                </button>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="modal_add" tabupdate="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Link Social Media</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('settings.update', 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="hidden" name="sosmed" id="sosmed" value="sosmed">
                            <input type="text" class="form-control" placeholder="Input facebook" name="facebook"
                                value="{{ $settings->facebook ?? '' }}">
                            <label for="facebook">Facebook</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Input twitter" name="twitter"
                                value="{{ $settings->twitter ?? '' }}">
                            <label for="twitter">Twitter</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Input ig" name="ig"
                                value="{{ $settings->ig ?? '' }}">
                            <label for="ig">Instagram</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Input youtube" name="youtube"
                                value="{{ $settings->youtube ?? '' }}">
                            <label for="youtube">Youtube</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Input linkedin" name="linkedin"
                                value="{{ $settings->linkedin ?? '' }}">
                            <label for="linkedin">Linked In</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
