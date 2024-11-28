@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="id"
            label="Id"
            :value="old('id', ($editing ? $user->id : ''))"
            max="255"
            placeholder="Id"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $user->foto ? \Storage::url($user->foto) : '' }}')"
        >
            <x-inputs.partials.label
                name="foto"
                label="Foto"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input type="file" name="foto" id="foto" @change="fileChosen" />
            </div>

            @error('foto') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="nim"
            label="Nim"
            :value="old('nim', ($editing ? $user->nim : ''))"
            max="255"
            placeholder="Nim"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="Prodi"
            label="Prodi"
            :value="old('Prodi', ($editing ? $user->Prodi : ''))"
            maxlength="255"
            placeholder="Prodi"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $user->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="tanggal"
            label="Tanggal"
            value="{{ old('tanggal', ($editing ? optional($user->tanggal)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>
</div>
