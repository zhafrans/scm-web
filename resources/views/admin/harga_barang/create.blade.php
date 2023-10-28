@extends('layouts.admin.admin')

@section('title')
    Buat Harga Barang
@endsection

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Harga Barang</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('index') }}">Home</a>&nbsp;<i
                        class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="{{ route('admin.harga_barang') }}">HargaBarang</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Tambah Harga Barang</header>
                </div>
                <div class="card-body " id="bar-parent2">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form action="{{ route('admin.harga_barang.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="selectbarang">Barang</label>
                                    <select class="form-control @error('barang_id') is-invalid @enderror"
                                        name="barang_id" aria-describedby="barangHelp" id="selectbarang"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($barang as $br)
                                            <option value="{{ $br->id }}">{{ $br->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                        <span id="barangHelp" class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="tanggal">Tanggal</label>
                                    <div class="form-group row">
                                        <div id="form_date1" class="input-group date form_date col-md-8" data-date=""
                                            data-date-format="dd MM yyyy" data-link-field="tanggal"
                                            data-link-format="yyyy-mm-dd">
                                            <input class="form-control" size="16" type="text" value="">
                                            <button class="btn btn-outline-secondary input-group-addon" type="button"
                                                id="button-addon2"><span class="fa fa-calendar"></span></button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="tanggal" name="tanggal" value="" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="selectjenis_outlet">Jenis Outlet</label>
                                    <select class="form-control @error('jenis_outlet_id') is-invalid @enderror"
                                        name="jenis_outlet_id" aria-describedby="jenis_outletHelp" id="selectjenis_outlet"
                                        required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($jenis_outlet as $jo)
                                            <option value="{{ $jo->id }}">{{ $jo->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_outlet_id')
                                        <span id="jenis_outletHelp" class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputHargaBarang">Harga Barang</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                        id="inputHargaBarang" aria-describedby="HargaBarangHelp"
                                        placeholder="Masukkan Harga Barang" autocomplete="off" value="{{ old('harga') }}"
                                        name="harga" required>
                                    @error('harga')
                                        <span id="HargaBarangHelp" class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-color">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-tambahan')
    <link href="{{ asset('assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"
        media="screen">
@endsection

@section('js-tambahan')
    <script src="{{ asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js') }}"></script>
    <script>
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#form_date1').datetimepicker('setDate', today);
    </script>
@endsection
