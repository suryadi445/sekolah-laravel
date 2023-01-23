@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" class="row g-3 needs-validation"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <div class="card mb-5 px-0">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="offset-sm-3 col-sm-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="tahun_ajaran_awal" name="tahun_ajaran_awal"
                                                aria-label="Floating label select example" required>
                                                <option value="">Pilih Tahun Ajaran</option>
                                                <option {{ date('Y') == $tahun_ajaran[0] ? 'selected' : '' }}
                                                    value="{{ date('Y') }}">{{ date('Y') }}</option>
                                                <option {{ date('Y') - 1 == $tahun_ajaran[0] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                                <option {{ date('Y') - 2 == $tahun_ajaran[0] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                                <option {{ date('Y') - 3 == $tahun_ajaran[0] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                                <option {{ date('Y') - 4 == $tahun_ajaran[0] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                                <option {{ date('Y') - 5 == $tahun_ajaran[0] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 5 }}">{{ date('Y') - 5 }}</option>
                                                <option {{ date('Y') - 6 == $tahun_ajaran[0] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 6 }}">{{ date('Y') - 6 }}</option>
                                            </select>
                                            <label for="tahun_ajaran_awal">Tahun Ajaran Awal</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="tahun_ajaran_akhir" name="tahun_ajaran_akhir"
                                                aria-label="Floating label select example" required
                                                value="{{ old('tahun_ajaran_akhir') }}">
                                                <option value="" selected>Plih Tahun Ajaran</option>
                                                <option {{ date('Y') + 1 == $tahun_ajaran[1] ? 'selected' : '' }}
                                                    value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                                                <option {{ date('Y') == $tahun_ajaran[1] ? 'selected' : '' }}
                                                    value="{{ date('Y') }}">{{ date('Y') }}</option>
                                                <option {{ date('Y') - 1 == $tahun_ajaran[1] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                                <option {{ date('Y') - 2 == $tahun_ajaran[1] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                                <option {{ date('Y') - 3 == $tahun_ajaran[1] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                                <option {{ date('Y') - 4 == $tahun_ajaran[1] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                                <option {{ date('Y') - 5 == $tahun_ajaran[1] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 5 }}">{{ date('Y') - 5 }}</option>
                                                <option {{ date('Y') - 6 == $tahun_ajaran[1] ? 'selected' : '' }}
                                                    value="{{ date('Y') - 6 }}">{{ date('Y') - 6 }}</option>
                                            </select>
                                            <label for="tahun_ajaran_akhir">Tahun Ajaran Akhir</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="kelas" name="kelas"
                                                aria-label="Floating label select example" required
                                                value="{{ old('kelas') }}">
                                                <option value="" disabled>Pilih Kelas</option>
                                                <option {{ $siswa->kelas == 0 ? 'selected' : '' }} value="0">
                                                    0
                                                </option>
                                                <option {{ $siswa->kelas == 1 ? 'selected' : '' }} value="1">
                                                    1
                                                </option>
                                                <option {{ $siswa->kelas == 2 ? 'selected' : '' }} value="2">
                                                    2
                                                </option>
                                                <option {{ $siswa->kelas == 3 ? 'selected' : '' }} value="3">
                                                    3
                                                </option>
                                                <option {{ $siswa->kelas == 4 ? 'selected' : '' }} value="4">
                                                    4
                                                </option>
                                                <option {{ $siswa->kelas == 5 ? 'selected' : '' }} value="5">
                                                    5
                                                </option>
                                                <option {{ $siswa->kelas == 6 ? 'selected' : '' }} value="6">
                                                    6
                                                </option>
                                            </select>
                                            <label for="kelas">Kelas</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_siswa" class="form-label">
                                        Nama Siswa
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required
                                        value="{{ old('nama_siswa', $siswa->nama_siswa) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nama Siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        required value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Tempat Lahir
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required
                                        value="{{ old('tgl_lahir', $siswa->tgl_lahir) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Tanggal Lahir
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label d-block">Jenis Kelamin
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="jenis_kelamin" value="laki-laki" checked
                                            {{ old('jenis_kelamin') == $siswa->jenis_kelamin ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="perempuan" value="perempuan"
                                            {{ old('jenis_kelamin') == $siswa->jenis_kelamin ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perempuan">
                                            Perempuan
                                        </label>
                                    </div>
                                    <div class="invalid-feedback">
                                        Mohon Isi Jenis Kelamin
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nis" class="form-label">Nomor Induk Siswa
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nis" name="nis" required
                                        value="{{ old('nis', $siswa->nis) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nomor Induk Siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nisn" class="form-label">Nomor Induk Siswa Nasional</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn"
                                        {{ old('nisn', $siswa->nisn) }}>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="agama" required value="{{ old('agama') }}">
                                        <option value="" disabled>Pilih Agama</option>
                                        <option {{ old('agama') == $siswa->agama ? 'selected' : '' }} value="Islam">
                                            Islam
                                        </option>
                                        <option {{ old('agama') == $siswa->agama ? 'selected' : '' }} value="Kristen">
                                            Kristen
                                        </option>
                                        <option {{ old('agama') == $siswa->agama ? 'selected' : '' }} value="Katolik">
                                            Katolik
                                        </option>
                                        <option {{ old('agama') == $siswa->agama ? 'selected' : '' }} value="Hindu">
                                            Hindu
                                        </option>
                                        <option {{ old('agama') == $siswa->agama ? 'selected' : '' }} value="Budha">
                                            Budha
                                        </option>
                                        <option {{ old('agama') == $siswa->agama ? 'selected' : '' }} value="Konghucu">
                                            Konghucu
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Mohon Isi Agama Siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>
                                    <div class="invalid-feedback">
                                        Mohon Isi Alamat Siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Foto Siswa</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row pt-3">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                        value="{{ old('nama_ayah', $siswa->nama_ayah) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_ayah" class="form-label">No Hp Ayah</label>
                                    <input type="number" class="form-control" id="no_hp_ayah" name="no_hp_ayah"
                                        value="{{ old('no_hp_ayah', $siswa->no_hp_ayah) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah"
                                        value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                        value="{{ old('nama_ibu', $siswa->nama_ibu) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_ibu" class="form-label">No Hp Ibu</label>
                                    <input type="number" class="form-control" id="no_hp_ibu" name="no_hp_ibu"
                                        value="{{ old('no_hp_ibu', $siswa->no_hp_ibu) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu"
                                        value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat_ortu" class="form-label">Alamat Orang Tua</label>
                                    <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3">{{ old('alamat_ortu', $siswa->alamat_ortu) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_wali" class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control" id="nama_wali" name="nama_wali"
                                        value="{{ old('nama_wali', $siswa->nama_wali) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_wali" class="form-label">No Hp Wali</label>
                                    <input type="number" class="form-control" id="no_hp_wali" name="no_hp_wali"
                                        value="{{ old('no_hp_wali', $siswa->no_hp_wali) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                    <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali"
                                        value="{{ old('pekerjaan_wali', $siswa->pekerjaan_wali) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                    <textarea class="form-control" id="alamat_wali" name="alamat_wali" rows="3">{{ old('alamat_wali', $siswa->alamat_wali) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row container mb-3">
                        <div class="offset-sm-10 col-sm-2">
                            <button type="submit" class="btn btn-primary float-end">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
