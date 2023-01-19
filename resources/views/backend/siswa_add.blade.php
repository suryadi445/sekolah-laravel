@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('siswa.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                {{ csrf_field() }}
                <div class="card mb-5">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="offset-sm-4 col-sm-4">
                                        <div class="form-floating">
                                            <select class="form-select" id="tahun_ajaran_awal" name="tahun_ajaran_awal"
                                                aria-label="Floating label select example" required
                                                value="{{ old('tahun_ajaran_awal') }}">
                                                <option value="" selected>Pilih Tahun Ajaran</option>
                                                <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                                <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                                <option value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                                <option value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                                <option value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                                <option value="{{ date('Y') - 5 }}">{{ date('Y') - 5 }}</option>
                                                <option value="{{ date('Y') - 6 }}">{{ date('Y') - 6 }}</option>
                                            </select>
                                            <label for="tahun_ajaran_awal">Tahun Ajaran Awal</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-floating">
                                            <select class="form-select" id="tahun_ajaran_akhir" name="tahun_ajaran_akhir"
                                                aria-label="Floating label select example" required
                                                value="{{ old('tahun_ajaran_akhir') }}">
                                                <option value="" selected>Plih Tahun Ajaran</option>
                                                <option value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                                                <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                                <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                                <option value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                                <option value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                                <option value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                                <option value="{{ date('Y') - 5 }}">{{ date('Y') - 5 }}</option>
                                                <option value="{{ date('Y') - 6 }}">{{ date('Y') - 6 }}</option>
                                            </select>
                                            <label for="tahun_ajaran_akhir">Tahun Ajaran Awal</label>
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
                                        value="{{ old('nama_siswa') }}">
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
                                        required value="{{ old('tempat_lahir') }}">
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
                                        value="{{ old('tgl_lahir') }}">
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
                                            id="jenis_kelamin" value="laki-laki" checked>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="perempuan" id="perempuan"
                                            value="perempuan">
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
                                        value="{{ old('nis') }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nomor Induk Siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nisn" class="form-label">Nomor Induk Siswa Nasional</label>
                                    <input type="text" class="form-control" id="nisn" name="nisn">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="agama" required value="{{ old('agama') }}">
                                        <option selected value="" disabled>Pilih Agama</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
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
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                    <div class="invalid-feedback">
                                        Mohon Isi Alamat Siswa
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row pt-3">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_ayah" class="form-label">No Hp Ayah</label>
                                    <input type="number" class="form-control" id="no_hp_ayah" name="no_hp_ayah">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" id="pekerjaan_ayah"
                                        name="pekerjaan_ayah">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_ibu" class="form-label">No Hp Ibu</label>
                                    <input type="number" class="form-control" id="no_hp_ibu" name="no_hp_ibu">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat_ortu" class="form-label">Alamat Orang Tua</label>
                                    <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_wali" class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_wali" class="form-label">No Hp Wali</label>
                                    <input type="number" class="form-control" id="no_hp_wali" name="no_hp_wali">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                    <input type="text" class="form-control" id="pekerjaan_wali"
                                        name="pekerjaan_wali">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                    <textarea class="form-control" id="alamat_wali" name="alamat_wali" rows="3"></textarea>
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
