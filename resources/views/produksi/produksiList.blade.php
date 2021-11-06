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
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Data Produksi Produk
                    </h3>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="20">No</th>
                                    <th>Kode Produksi</th>
                                    <th>Lokasi</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Publish</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_produksi as $produksi)
                                    <tr>
                                        <td>{{ $produksi->id }}</td>
                                        <td>{{ $produksi->kode_produksi }}</td>
                                        <td>{{ $produksi->lokasi->lokasi }}</td>
                                        <td>{{ $produksi->tgl_mulai_produksi }}</td>
                                        <td>{{ $produksi->tgl_selesai_produksi }}</td>
                                        <td>{{ $produksi->status }}</td>
                                        <td>{{ $produksi->publish }}</td>
                                        <td>
                                            <a href="#" class="badge badge-warning p-2">Edit</a>
                                            <a href="#" class="badge badge-danger p-2">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
