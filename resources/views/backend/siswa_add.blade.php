@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('siswa.store') }}" method="POST" class="row g-3 needs-validation"
                enctype="multipart/form-data" novalidate>
                {{ csrf_field() }}
                <div class="card mb-5 px-0">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="offset-sm-3 col-sm-3 mt-1 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="tahun_ajaran_awal" name="tahun_ajaran_awal"
                                                aria-label="Floating label select example" required
                                                value="{{ old('tahun_ajaran_awal') }}">
                                                <option value="" selected>Pilih Tahun Ajaran</option>
                                                <option {{ old('tahun_ajaran_awal') == date('Y') ? 'selected' : '' }}
                                                    value="{{ date('Y') }}">{{ date('Y') }}</option>
                                                <option {{ old('tahun_ajaran_awal') == date('Y') - 1 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                                <option {{ old('tahun_ajaran_awal') == date('Y') - 2 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                                <option {{ old('tahun_ajaran_awal') == date('Y') - 3 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                                <option {{ old('tahun_ajaran_awal') == date('Y') - 4 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                                <option {{ old('tahun_ajaran_awal') == date('Y') - 5 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 5 }}">{{ date('Y') - 5 }}</option>
                                                <option {{ old('tahun_ajaran_awal') == date('Y') - 6 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 6 }}">{{ date('Y') - 6 }}</option>
                                            </select>
                                            <label for="tahun_ajaran_awal">Tahun Ajaran Awal</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3  mt-1 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="tahun_ajaran_akhir" name="tahun_ajaran_akhir"
                                                aria-label="Floating label select example" required
                                                value="{{ old('tahun_ajaran_akhir') }}">
                                                <option value="" selected>Plih Tahun Ajaran</option>
                                                <option {{ old('tahun_ajaran_akhir') == date('Y') + 1 ? 'selected' : '' }}
                                                    value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                                                <option {{ old('tahun_ajaran_akhir') == date('Y') ? 'selected' : '' }}
                                                    value="{{ date('Y') }}">{{ date('Y') }}</option>
                                                <option {{ old('tahun_ajaran_akhir') == date('Y') - 1 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                                <option {{ old('tahun_ajaran_akhir') == date('Y') - 2 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                                <option {{ old('tahun_ajaran_akhir') == date('Y') - 3 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                                <option {{ old('tahun_ajaran_akhir') == date('Y') - 4 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                                <option {{ old('tahun_ajaran_akhir') == date('Y') - 5 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 5 }}">{{ date('Y') - 5 }}</option>
                                                <option {{ old('tahun_ajaran_akhir') == date('Y') - 6 ? 'selected' : '' }}
                                                    value="{{ date('Y') - 6 }}">{{ date('Y') - 6 }}</option>
                                            </select>
                                            <label for="tahun_ajaran_akhir">Tahun Ajaran Awal</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3  mt-1 mb-1">
                                        <div class="form-floating">
                                            <select class="form-select" id="kelas" name="kelas"
                                                aria-label="Floating label select example" required
                                                value="{{ old('kelas') }}">
                                                <option value="" disabled selected>Pilih Kelas</option>
                                                @foreach ($kelas as $item)
                                                    <option {{ old('kelas') ? 'selected' : '' }}
                                                        value="{{ $item->kelas . '.' . $item->sub_kelas }}">
                                                        {{ $item->kelas . '.' . $item->sub_kelas }}
                                                    </option>
                                                @endforeach
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
                                        value="{{ old('nama_siswa') }}">
                                    <div class="invalid-feedback">
                                        Mohon Isi Nama Siswa
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="provinsi" class="form-label">Provinsi Tempat Lahir
                                        <span class="text-danger">*</span>
                                    </label>
                                    <span class="select2-selection select2-selection--single form-control input-lg"
                                        role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                        aria-labelledby="select2-e8ez-container" style="border: 0.1px solid #ced4da;">
                                        <select class="form-select select2" id="provinsi" name="provinsi"
                                            data-select2-id="provinsi" value="{{ old('provinsi') }}" required>
                                            <option value="" disabled selected>Pilih Provinsi</option>
                                            @foreach (getProvinsi() as $item)
                                                <option {{ old('provinsi') == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Mohon Isi Tempat Lahir
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir
                                            <span class="text-danger">*</span>
                                        </label>
                                        <span class="select2-selection select2-selection--single form-control input-lg"
                                            role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-labelledby="select2-e8ez-container" style="border: 0.1px solid #ced4da;">
                                            <select class="form-select select2" id="tempat_lahir" name="tempat_lahir"
                                                data-select2-id="kota" required value="{{ old('tempat_lahir') }}">
                                                <option value="" disabled selected>
                                                    Pilih Tempat Lahir
                                                </option>
                                            </select>

                                            <div class="invalid-feedback">
                                                Mohon Isi Tempat Lahir
                                            </div>
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
                                            id="jenis_kelamin" value="laki-laki" checked
                                            {{ old('jenis_kelamin') == 'laki-laki' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                            id="perempuan" value="perempuan"
                                            {{ old('jenis_kelamin') == 'perempuan' ? 'checked' : '' }}>
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
                                    <label for="agama" class="form-label">Agama
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" name="agama" required value="{{ old('agama') }}">
                                        <option selected value="" disabled>Pilih Agama</option>
                                        <option {{ old('agama') == 'Islam' ? 'selected' : '' }} value="Islam">Islam
                                        </option>
                                        <option {{ old('agama') == 'Kristen' ? 'selected' : '' }} value="Kristen">Kristen
                                        </option>
                                        <option {{ old('agama') == 'Katolik' ? 'selected' : '' }} value="Katolik">Katolik
                                        </option>
                                        <option {{ old('agama') == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu
                                        </option>
                                        <option {{ old('agama') == 'Budha' ? 'selected' : '' }} value="Budha">Budha
                                        </option>
                                        <option {{ old('agama') == 'Konghucu' ? 'selected' : '' }} value="Konghucu">
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
                                    <input type="text" class="form-control" id="nisn" name="nisn"
                                        {{ old('nisn') }}>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
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
                                        value="{{ old('nama_ayah') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_ayah" class="form-label">No Hp Ayah</label>
                                    <input type="number" class="form-control" id="no_hp_ayah" name="no_hp_ayah"
                                        value="{{ old('no_hp_ayah') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah"
                                        value="{{ old('pekerjaan_ayah') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                        value="{{ old('nama_ibu') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_ibu" class="form-label">No Hp Ibu</label>
                                    <input type="number" class="form-control" id="no_hp_ibu" name="no_hp_ibu"
                                        value="{{ old('no_hp_ibu') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu"
                                        value="{{ old('pekerjaan_ibu') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat_ortu" class="form-label">Alamat Orang Tua</label>
                                    <textarea class="form-control" id="alamat_ortu" name="alamat_ortu" rows="3">{{ old('alamat_ortu') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="nama_wali" class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control" id="nama_wali" name="nama_wali"
                                        value="{{ old('nama_wali') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="no_hp_wali" class="form-label">No Hp Wali</label>
                                    <input type="number" class="form-control" id="no_hp_wali" name="no_hp_wali"
                                        value="{{ old('no_hp_wali') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="pekerjaan_wali" class="form-label">Pekerjaan Wali</label>
                                    <input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali"
                                        value="{{ old('pekerjaan_wali') }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="alamat_wali" class="form-label">Alamat Wali</label>
                                    <textarea class="form-control" id="alamat_wali" name="alamat_wali" rows="3">{{ old('alamat_wali') }}</textarea>
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
        $(document).ready(function() {

            $(document).on("change", "#provinsi", function() {
                $('#loading').show();

                let provinsi = this.value;

                $.ajax({
                    type: "GET",
                    url: "/siswa/getKota?id_provinsi=" + provinsi,
                    dataType: "json",
                    success: function(response) {
                        $('#loading').hide();

                        $.each(response, function(index, value) {
                            var provinsi = value.nama;
                            var id_kota = value.id;

                            $('#tempat_lahir').append($('<option>', {
                                value: id_kota,
                                text: provinsi,
                            }));
                        });
                    }
                });
            });
        });
    </script>
@endsection
