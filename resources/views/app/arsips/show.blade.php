@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('arsips.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.arsips.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.id')</h5>
                    <span>{{ $arsip->id ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.nomor_surat')</h5>
                    <span>{{ $arsip->nomor_surat ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.judul')</h5>
                    <span>{{ $arsip->judul ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.kategorisurat_id')</h5>
                    <span
                        >{{ optional($arsip->kategorisurat)->nama_kategori ??
                        '-' }}</span
                    >
                </div>
                <div>
                    <embed src="{{\Storage::url($arsip->flie_path)}}" type="application/pdf" width="100%" height="600px">
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.flie_path')</h5>
                    @if($arsip->flie_path)
                    <a
                        href="{{ \Storage::url($arsip->flie_path) }}"
                        target="blank"
                        ><i class="icon ion-md-download"></i>&nbsp;Download</a
                    >
                    @else - @endif
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.waktu_pengarsipan')</h5>
                    <span>{{ $arsip->waktu_pengarsipan ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('arsips.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Arsip::class)
                <a href="{{ route('arsips.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
