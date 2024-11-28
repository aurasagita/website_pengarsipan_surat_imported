@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Arsip::class)
                <a href="{{ route('arsips.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.arsips.index_title')</h4>
            </div>

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
                        @forelse($arsips as $arsip)
                        <tr>
                            <td>{{ $arsip->id ?? '-' }}</td>
                            <td>{{ $arsip->nomor_surat ?? '-' }}</td>
                            <td>{{ $arsip->judul ?? '-' }}</td>
                            <td>
                                {{
                                optional($arsip->kategorisurat)->nama_kategori
                                ?? '-' }}
                            </td>
                            <td>
                                @if($arsip->flie_path)
                                <a
                                    href="{{ \Storage::url($arsip->flie_path) }}"
                                    target="blank"
                                    ><i class="icon ion-md-download"></i
                                    >&nbsp;Download</a
                                >
                                @else - @endif
                            </td>
                            <td>{{ $arsip->waktu_pengarsipan ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $arsip)
                                    <a
                                        href="{{ route('arsips.edit', $arsip) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $arsip)
                                    <a
                                        href="{{ route('arsips.show', $arsip) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $arsip)
                                    <form
                                        action="{{ route('arsips.destroy', $arsip) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">{!! $arsips->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
