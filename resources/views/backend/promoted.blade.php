@extends('layouts.admin.admin')

@section('admin')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="offset-md-6 col-md-3 mt-3 mt-sm-0">
                            <select class="form-select" id="kelas">
                                <option value="">Semua Kelas</option>
                                @foreach (arrayKelas() as $item)
                                    <option {{ request('kelas') == $item ? 'selected' : '' }} value="{{ $item }}">
                                        Kelas {{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mt-2 mt-sm-0">
                            <select class="form-select" id="subKelas">
                                <option value="">Semua Sub Kelas</option>
                                @foreach ($subKelas as $item)
                                    <option {{ request('subKelas') == $item->sub_kelas ? 'selected' : '' }}
                                        value="{{ $item->sub_kelas }}"> {{ $item->sub_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="p-3 mt-2 table-responsive">
                    <table
                        class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden data-table"
                        width="100%">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Wali Kelas</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Sub Kelas</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($kelas) > 0)
                                @foreach ($kelas as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nama_guru }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->sub_kelas }}</td>
                                        <td>
                                            <a href="promoted/show/{{ $item->kelas . '/' . $item->sub_kelas }}"
                                                class="badge text-bg-info d-block text-decoration-none text-light">
                                                Detail
                                            </a>
                                            @isset($cekNaikKelas)
                                                <a href="promoted/edit/{{ $item->kelas . '/' . $item->sub_kelas }}"
                                                    class="badge text-bg-warning d-block text-decoration-none text-light mt-2">
                                                    Edit
                                                </a>
                                            @endisset
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="100%" class="text-danger">Data Tidak Tersedia</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('change', '#kelas', function() {
            var kelas = $(this).val();
            var subKelas = $('#subKelas').val();
            window.location = "/promoted?kelas=" + kelas + '&subKelas=' + subKelas;
        })

        $(document).on('change', '#subKelas', function() {
            var subKelas = $(this).val();
            var kelas = $('#kelas').val();
            window.location = "/promoted?kelas=" + kelas + '&subKelas=' + subKelas;
        })
    </script>
@endsection
