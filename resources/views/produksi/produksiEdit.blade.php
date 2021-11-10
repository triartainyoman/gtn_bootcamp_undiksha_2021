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
                        Edit Data Produksi
                    </h3>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">
                    <form action="{{ route('produksiUpdate', [$edit->id]) }}" method="POST"
                        class="form-send m-form m-form--fit m-form--label-align-right"
                        data-redirect="{{ route('produksiList') }}">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group">
                                <label for="kode_produksi">
                                    Kode Produksi
                                </label>
                                <input type="text" name="kode_produksi" class="form-control m-input" id="kode_produksi"
                                    value="{{ $edit->kode_produksi }}" placeholder="Masukan Kode Produksi" required>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="tgl_mulai_produksi">
                                    Mulai Produksi
                                </label>
                                <input type="date" name="tgl_mulai_produksi" class="form-control m-input"
                                    id="tgl_mulai_produksi" value="{{ $edit->tgl_mulai_produksi }}" required>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="tgl_selesai_produksi">
                                    Selesai Produksi
                                </label>
                                <input type="date" name="tgl_selesai_produksi" class="form-control m-input"
                                    id="tgl_selesai_produksi" value="{{ $edit->tgl_selesai_produksi }}" required>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="id_lokasi">
                                    Pabrik
                                </label>
                                <select class="form-control m-input" name="id_lokasi" id="id_lokasi">
                                    @foreach ($lokasi as $row)
                                        <option value="{{ $row->id }}" {{ $edit->id == $row->id ? 'selected' : '' }}>
                                            {{ $row->kode_lokasi . ' - ' . $row->lokasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="catatan">
                                    Catatan
                                </label>
                                <textarea class="form-control m-input" name="catatan" id="catatan"
                                    rows="3">{{ $edit->catatan }}</textarea>
                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-primary">
                                    Edit Produksi
                                </button>
                                <a href="{{ route('produksiList') }}" class="btn btn-danger">
                                    Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
