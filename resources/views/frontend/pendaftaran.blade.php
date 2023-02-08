@extends('layouts.landing')


@section('container')
    @include('layouts.jumbotron')

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h1>Pendaftaran Siswa Baru</h1>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card shadow p-3 mb-5 pb-5 bg-body rounded">
                    <div class="row">
                        <div class="col-sm-12">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="card shadow mx-2 bg-body-tertiary rounded">
                                <div class="card-header">
                                    <h2 class="text-center">Tahun Ajaran ....</h2>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row p-2">
                                            <div class="col-sm-4 mt-2">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama">
                                            </div>
                                            <div class="col-sm-4 mt-2">
                                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempat_lahir"
                                                    name="tempat_lahir">
                                            </div>
                                            <div class="col-sm-4 mt-2">
                                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                            </div>
                                            <div class="col-sm-4 mt-2">
                                                <label for="nama" class="form-label d-block">Jenis Kelamin</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                        value="Laki-Laki" id="laki-laki">
                                                    <label class="form-check-label" for="laki-laki">
                                                        Laki-Laki
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                        value="Perempuan" id="perempuan">
                                                    <label class="form-check-label" for="perempuan">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 mt-2">
                                                <label for="agama" class="form-label">Agama</label>
                                                <select class="form-select" aria-label="Default select example">
                                                    <option selected value="" disabled>Pilih Agama</option>
                                                    <option {{ old('agama') == 'Islam' ? 'selected' : '' }} value="Islam">
                                                        Islam
                                                    </option>
                                                    <option {{ old('agama') == 'Kristen' ? 'selected' : '' }}
                                                        value="Kristen">
                                                        Kristen
                                                    </option>
                                                    <option {{ old('agama') == 'Katolik' ? 'selected' : '' }}
                                                        value="Katolik">
                                                        Katolik
                                                    </option>
                                                    <option {{ old('agama') == 'Hindu' ? 'selected' : '' }} value="Hindu">
                                                        Hindu
                                                    </option>
                                                    <option {{ old('agama') == 'Budha' ? 'selected' : '' }} value="Budha">
                                                        Budha
                                                    </option>
                                                    <option {{ old('agama') == 'Konghucu' ? 'selected' : '' }}
                                                        value="Konghucu">
                                                        Konghucu
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 mt-2">
                                                <label for="no_hp" class="form-label">No. Handphone</label>
                                                <input type="number" class="form-control" id="no_hp" name="no_hp">
                                            </div>
                                            <div class="col-sm-4 mt-2">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" aria-label="With textarea" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mt-3 p-2">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
