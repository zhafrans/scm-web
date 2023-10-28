@extends('layouts.admin.admin')

@section('title')
    Buat Barang Masuk
@endsection

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Barang Masuk</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('index') }}">Home</a>&nbsp;<i
                        class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="{{ route('admin.barang_masuk') }}">Barang Masuk</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Tambah Barang Masuk</header>
                </div>
                <div class="card-body " id="bar-parent2">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form action="{{ route('admin.barang_masuk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="selectjenisBarang Masuk">Jenis Barang Masuk</label>
                                    <select class="form-control @error('id_jenis') is-invalid @enderror"
                                        name="id_jenis" aria-describedby="jenisBarang MasukHelp" id="selectjenisBarang Masuk" required>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($jenis_barang Masuk as $jns)
                                            <option value="{{ $jns->id }}">{{ $jns->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_jenis')
                                        <span id="jenisBarang MasukHelp" class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputBarang Masuk">Nama Barang Masuk</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="inputBarang Masuk" aria-describedby="Barang MasukHelp" placeholder="Masukkan nama Barang Masuk"
                                        autocomplete="off" value="{{ old('nama') }}" name="nama" required>
                                    @error('nama')
                                        <span id="Barang MasukHelp" class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="checkbox checkbox-icon-black">
                                        <input id="checkbox1" name="fisik" type="checkbox" value="1" checked="checked">
                                        <label for="checkbox1">
                                            Barang Masuk Fisik
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputKeterangan">Keterangan</label>
                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="inputKeterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
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
<link href="{{ asset('assets/css/pages/formlayout.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js-tambahan')
@endsection
