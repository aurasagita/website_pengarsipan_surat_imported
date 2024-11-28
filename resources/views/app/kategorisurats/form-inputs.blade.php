@php $editing = isset($kategorisurat) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="id"
            label="Id"
            :value="old('id', ($editing ? $kategorisurat->id : ''))"
            max="255"
            placeholder="Id"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nama_kategori"
            label="Nama Kategori"
            :value="old('nama_kategori', ($editing ? $kategorisurat->nama_kategori : ''))"
            maxlength="255"
            placeholder="Nama Kategori"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="keterangan"
            label="Keterangan"
            :value="old('keterangan', ($editing ? $kategorisurat->keterangan : ''))"
            maxlength="255"
            placeholder="Keterangan"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
