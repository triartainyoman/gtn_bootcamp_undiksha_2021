@extends('components.index')

@section('css')

@endsection

@section('js')
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title">
                        Tambah Data Produksi
                    </h3>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <form action="{{ route('produksiInsert') }}" method="POST"
            class="form-send m-form m-form--fit m-form--label-align-right" data-redirect="{{ route('produksiList') }}">
            {{ csrf_field() }}

            <div class="m-content">
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-placeholder-2"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Data Produksi
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label for="kode_produksi">
                                    Kode Produksi
                                </label>
                                <input type="text" name="kode_produksi" class="form-control m-input form-control-danger"
                                    id="kode_produksi" placeholder="Masukan Kode Produksi" required>
                                {{-- <div class="form-control-feedback">
                                    Sorry, that kode produksi required!
                                </div> --}}
                            </div>

                            <div class="form-group m-form__group">
                                <label for="tgl_mulai_produksi">
                                    Mulai Produksi
                                </label>
                                <input type="date" name="tgl_mulai_produksi" class="form-control m-input"
                                    id="tgl_mulai_produksi" required>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="tgl_selesai_produksi">
                                    Selesai Produksi
                                </label>
                                <input type="date" name="tgl_selesai_produksi" class="form-control m-input"
                                    id="tgl_selesai_produksi" required>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="id_lokasi">
                                    Pabrik
                                </label>
                                <select class="form-control m-input" name="id_lokasi" id="id_lokasi">
                                    @foreach ($lokasi as $row)
                                        <option value="{{ $row->id }}">{{ $row->kode_lokasi . ' - ' . $row->lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="catatan">
                                    Catatan
                                </label>
                                <textarea class="form-control m-input" name="catatan" id="catatan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pilih Produk --}}
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-placeholder-2"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Pilih Produk
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <button type="button" class="btn btn-success btn-produk-tambah">Tambah Produk</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <table class="table table-bordered table-striped table-produk">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Qty Produksi</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Daftar Bahan --}}
                <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon">
                                    <i class="flaticon-placeholder-2"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Daftar Bahan
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-portlet__body data-bahan-view">

                        </div>
                    </div>
                </div>

                {{-- Button --}}
                <div class="m-portlet akses-list">
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions text-center">
                            <button type="submit" class="btn btn-primary">
                                Mulai Produksi
                            </button>
                            <a href="{{ route('produksiList') }}" class="btn btn-danger">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>

    {{-- Produk row --}}
    <div class="m--hide">
        <table class="table-produk-row">
            <tbody>
                <tr>
                    <td class="produk">
                        <select name="id_produk[]" class="form-control">
                            <option value="">Pilih Nama Produk</option>
                            @foreach ($produk as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_produk }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="qty">
                        <input type="number" class="form-control" name="qty_produksi[]" value="0" min="0">
                    </td>
                    <td>
                        <textarea name="keterangan[]" class="form-control"></textarea>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-produk-hapus">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
