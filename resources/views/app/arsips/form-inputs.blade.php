@php $editing = isset($arsip) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="id"
            label="Id"
            :value="old('id', ($editing ? $arsip->id : ''))"
            max="255"
            placeholder="Id"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nomor_surat"
            label="Nomor Surat"
            :value="old('nomor_surat', ($editing ? $arsip->nomor_surat : ''))"
            maxlength="255"
            placeholder="Nomor Surat"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="judul"
            label="Judul"
            :value="old('judul', ($editing ? $arsip->judul : ''))"
            maxlength="255"
            placeholder="Judul"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="kategorisurat_id" label="Kategorisurat" required>
            @php $selected = old('kategorisurat_id', ($editing ? $arsip->kategorisurat_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Kategorisurat</option>
            @foreach($kategorisurats as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.partials.label
            name="flie_path"
            label="Flie Path"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="flie_path"
            id="flie_path"
            class="form-control-file"
        />

        @if($editing && $arsip->flie_path)
        <div class="mt-2">
            <a href="{{ \Storage::url($arsip->flie_path) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('flie_path') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime
            name="waktu_pengarsipan"
            label="Waktu Pengarsipan"
            value="{{ old('waktu_pengarsipan', ($editing ? optional($arsip->waktu_pengarsipan)->format('Y-m-d\TH:i:s') : '')) }}"
            max="255"
            required
        ></x-inputs.datetime>
    </x-inputs.group>
</div>
