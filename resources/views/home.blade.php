@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @section('content')
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Selamat datang di aplikasi Pengarsipan Surat Resmi Kelurahan, selamat bekerja
                    {{ Auth::user()->name }}
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-md-12 grid-margin">
                    @if (session('message'))
                        <h6 class="alert alert-success">{{ session('message')}},</h6>
                    @endif
                    </div>
                </div>
                <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <b><h1>Dashboard</h1></b>
                        </div>
                      </div>

                        <div class="card-header border-0">
                            <!-- Main content -->
                            <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title"><i class="nav-icon icon ion-md-pulse"></i> Dashboard</h3>
                                </div>
                                <div class="card-body">
                        <section class="content">

                                <!-- Default box -->
                                <div class="container-fluid">
                                    <!-- Small boxes (Stat box) -->
                                    <div class="row">
                                        <div class="col-lg-4 col-6">
                                            <!-- small box -->
                                            @if (Auth::user())
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    <h3>{{ $countUser }}</h3>
                                                    <p>User</p>
                                                </div>
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <i class="nav-icon icon ion-md-person" style="font-size: 2.5rem;"></i>
                                                </div>
                                                <a href="{{ url('/users') }}" class="small-box-footer">More info <i class="nav-icon icon ion-md-arrow-forward" style="font-size: 1.5rem;"></i></a>
                                            </div>
                                            @else
                                            <div class="small-box bg-info">
                                                <div class="inner">
                                                    {{-- <h3>{{ $countArsips }}</h3> --}}
                                                    <p>Arsip Surat</p>
                                                </div>
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <i class="nav-icon icon ion-md-document" style="font-size: 2.5rem;"></i>
                                                </div>
                                                <a href="{{ url('/arsips') }}" class="small-box-footer">More info <i class="nav-icon icon ion-md-arrow-forward" style="font-size: 1.5rem;"></i></a>
                                            </div>
                                            @endif
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-lg-4 col-6">
                                            <!-- small box -->
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3>{{ $countKategorisurat }}</h3>
                                                    <p>Kategori Surat</p>
                                                </div>
                                                <div class="icon d-flex align-items-center justify-content-center">
                                                    <i class="nav-icon icon ion-md-create" style="font-size: 2.5rem;"></i>
                                                </div>
                                                <a href="{{ url('/kategorisurats') }}" class="small-box-footer">More info <i class="nav-icon icon ion-md-arrow-forward" style="font-size: 1.5rem;"></i></a>
                                            </div>
                                        </div>
                            </div>
                                     <!-- Table Section for Form Pemeliharaan -->
                                     <div class="card">
                                        <div class="card-header">
                                            <b>Data Arsip Surat</b>
                                        </div>
                                        <div class="row d-flex justify-between" style="width: 100%; justify-content: space-between; align-items: center; margin: 0">
                                            <form class="form" method="GET" action="{{ url('arsips') }}" class="col-md-4" style="padding: 0">
                                              <div class="form-group w-100 mb-3">
                                              </div>
                                            </form>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-right">
                                                                @lang('crud.arsips.inputs.id')
                                                            </th>
                                                            <th class="text-left">
                                                                @lang('crud.arsips.inputs.nomor_surat')
                                                            </th>
                                                            <th class="text-left">
                                                                @lang('crud.arsips.inputs.judul')
                                                            </th>
                                                            <th class="text-left">
                                                                @lang('crud.arsips.inputs.kategorisurat_id')
                                                            </th>
                                                            <th class="text-left">
                                                                @lang('crud.arsips.inputs.flie_path')
                                                            </th>
                                                            <th class="text-left">
                                                                @lang('crud.arsips.inputs.waktu_pengarsipan')
                                                            </th>
                                                            <th class="text-center">
                                                                @lang('crud.common.actions')
                                                            </th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        @forelse ($pemeliharaans as $index => $pemeliharaan)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $pemeliharaan->tanggal ?? '-' }}</td>
                                                                <td>{{ $pemeliharaan->periode ?? '-' }}</td>
                                                                <td>{{ $pemeliharaan->cuaca ?? '-' }}</td>
                                                                <td>{{ $pemeliharaan->user->name ?? '-' }}</td>
                                                                <td>{{ $pemeliharaan->alatTelemetri->lokasiStasiun ?? '-' }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="9" class="text-center">No data available</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    </div>
        @endsection
    </div>
</div>
@endsection
