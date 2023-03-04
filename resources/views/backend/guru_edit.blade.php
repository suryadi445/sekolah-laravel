@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('guru.update', $guru->id) }}" method="POST" class="row g-3 needs-validation"
                enctype="multipart/form-data" novalidate>
                @method('PUT')
                @csrf
                <div class="card mb-5 px-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control text-capitalize" id="nik" name="nik"
                                        required value="{{ old('nik', $guru->nik) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi NIK
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_guru" class="form-label">
                                        Nama Guru
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control text-capitalize" id="nama_guru"
                                        name="nama_guru" required value="{{ old('nama_guru', $guru->nama_guru) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nama guru
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="gelar" class="form-label">
                                        Gelar
                                    </label>
                                    <input type="text" class="form-control text-capitalize" id="gelar" name="gelar"
                                        value="{{ old('gelar', $guru->gelar) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nama guru
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="pendidikan_terakhir" required
                                        value="{{ old('pendidikan_terakhir') }}">
                                        <option value="" disabled>Pilih Pendidikan Terakhir</option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}
                                            value="SD">
                                            SD
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}
                                            value="SMP">
                                            SMP
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'SMA' ? 'selected' : '' }}
                                            value="SMA">
                                            SMA
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D1' ? 'selected' : '' }}
                                            value="D1">
                                            D1
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D2' ? 'selected' : '' }}
                                            value="D2">
                                            D2
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}
                                            value="D3">
                                            D3
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'D4' ? 'selected' : '' }}
                                            value="D4">
                                            D4
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}
                                            value="S1">
                                            S1
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}
                                            value="S2">
                                            S2
                                        </option>
                                        <option
                                            {{ old('pendidikan_terakhir', $guru->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}
                                            value="S3">
                                            S3
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Mohon Isi Pendidikan Terakhir
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="program_studi" class="form-label">Program Studi
                                    </label>
                                    <input type="text" class="form-control text-capitalize" id="program_studi"
                                        name="program_studi" value="{{ old('program_studi', $guru->program_studi) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Program studi
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alumni_dari" class="form-label">Alumni Dari
                                    </label>
                                    <input type="text" class="form-control text-capitalize" id="alumni_dari"
                                        name="alumni_dari" value="{{ old('alumni_dari', $guru->alumni_dari) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Tanggal Lahir
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="jabatan" name="jabatan" value="{{ old('jabatan') }}"
                                        required>
                                        <option selected value="" disabled>Pilih Jabatan</option>
                                        @foreach ($jabatan as $item)
                                            <option
                                                {{ old('jabatan', $guru->jabatan) == $item->nama_jabatan ? 'selected' : '' }}
                                                value="{{ $item->nama_jabatan }}">{{ ucfirst($item->nama_jabatan) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Mohon Isi Jabatan
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select select2" name="tempat_lahir" id="tempat_lahir" required
                                        value="{{ old('tempat_lahir') }}">
                                        <option selected value="" disabled>Pilih Tempat Lahir</option>
                                        @foreach (arrayKota() as $item)
                                            <option
                                                {{ old('tempat_lahir', $guru->tempat_lahir) == $item ? 'selected' : '' }}
                                                value="{{ $item }}">
                                                {{ strtoupper($item) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Mohon Isi Tempat Lahir
                                    </div>
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
                                    <input type="date" class="form-control text-capitalize" id="tgl_lahir"
                                        name="tgl_lahir" required value="{{ old('tgl_lahir', $guru->tgl_lahir) }}">
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
                                            {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'laki-laki' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="perempuan" value="perempuan"
                                            {{ old('jenis_kelamin', $guru->jenis_kelamin) == 'perempuan' ? 'checked' : '' }}>
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
                                    <label for="no_hp" class="form-label">Nomor Hp
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control text-capitalize" id="no_hp"
                                        name="no_hp" required value="{{ old('no_hp', $guru->no_hp) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nomor Handphone
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email
                                    </label>
                                    <input type="email" class="form-control text-capitalize" id="email"
                                        name="email" value="{{ old('email', $guru->email) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Email Yang Valid
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="agama" required value="{{ old('agama') }}">
                                        <option selected value="" disabled>Pilih Agama</option>
                                        <option {{ old('agama', $guru->agama) == 'Islam' ? 'selected' : '' }}
                                            value="Islam">Islam
                                        </option>
                                        <option {{ old('agama', $guru->agama) == 'Kristen' ? 'selected' : '' }}
                                            value="Kristen">
                                            Kristen
                                        </option>
                                        <option {{ old('agama', $guru->agama) == 'Katolik' ? 'selected' : '' }}
                                            value="Katolik">
                                            Katolik
                                        </option>
                                        <option {{ old('agama', $guru->agama) == 'Hindu' ? 'selected' : '' }}
                                            value="Hindu">
                                            Hindu
                                        </option>
                                        <option {{ old('agama', $guru->agama) == 'Budha' ? 'selected' : '' }}
                                            value="Budha">
                                            Budha
                                        </option>
                                        <option {{ old('agama', $guru->agama) == 'Konghucu' ? 'selected' : '' }}
                                            value="Konghucu">
                                            Konghucu
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Mohon Isi Agama Guru
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP
                                    </label>
                                    <input type="text" class="form-control text-capitalize" id="nip"
                                        name="nip" value="{{ old('nip', $guru->nip) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi NIP
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nuptk" class="form-label">NUPTK</label>
                                    <input type="text" class="form-control text-capitalize" id="nuptk"
                                        name="nuptk" value=" {{ old('nuptk', $guru->nuptk) }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="mulai_tugas" class="form-label">Mulai Tugas
                                    </label>
                                    <input type="date" class="form-control" id="mulai_tugas" name="mulai_tugas"
                                        value="{{ old('mulai_tugas', $guru->mulai_tugas) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Mulai Tugas
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_rekening" class="form-label">Nomor Rekening
                                    </label>
                                    <input type="number" class="form-control text-capitalize" id="no_rekening"
                                        name="no_rekening" value="{{ old('no_rekening', $guru->no_rekening) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nomor Rekening
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_bank" class="form-label">Nama Bank
                                    </label>
                                    <input type="text" class="form-control text-capitalize" id="nama_bank"
                                        name="nama_bank" value="{{ old('nama_bank', $guru->nama_bank) }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nomor Induk guru
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control text-capitalize" id="alamat" name="alamat" rows="3" placeholder=""
                                        required>
                                        {{ old('alamat', $guru->alamat) }}
                                    </textarea>
                                    <div class="invalid-feedback">
                                        Mohon Isi Alamat Guru
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Foto Guru</label>
                                    <input type="file" class="form-control text-capitalize" id="image"
                                        name="image">
                                </div>
                            </div>
                            @if ($guru->image)
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label for="image" class="form-label d-block">Foto Sekarang</label>
                                        <img src="{{ $guru->image }}" alt="image" width="100">
                                    </div>
                                </div>
                            @endif
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
