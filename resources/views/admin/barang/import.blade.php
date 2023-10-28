@extends('layouts.admin.admin')

@section('title')
    Import Barang
@endsection

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            <div class=" pull-left">
                <div class="page-title">Barang</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('index') }}">Home</a>&nbsp;<i
                        class="fa fa-angle-right"></i>
                </li>
                <li><a class="parent-item" href="{{ route('admin.barang.import') }}">Import Barang</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head">
                    <header>Import Barang</header>
                </div>
                <div class="card-body " id="bar-parent2">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form action="{{ route('admin.barang.import_excel') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">                                    
                                    <label class="form-label">Pilih file excel</label>
                                    <input type="file" class="form-control" name="file" required="required">
                                    @error('excel')
                                        <span id="FileHelp" class="invalid-feedback" role="alert">
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
    <link href="{{ asset('assets/css/pages/formlayout.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js-tambahan')
@endsection
