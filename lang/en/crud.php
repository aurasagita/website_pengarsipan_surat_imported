<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'id' => 'Id',
            'name' => 'Name',
            'foto' => 'Foto',
            'nim' => 'Nim',
            'Prodi' => 'Prodi',
            'email' => 'Email',
            'tanggal' => 'Tanggal',
            'password' => 'Password',
        ],
    ],

    'kategorisurats' => [
        'name' => 'Kategorisurats',
        'index_title' => 'Kategorisurats List',
        'new_title' => 'New Kategorisurat',
        'create_title' => 'Create Kategorisurat',
        'edit_title' => 'Edit Kategorisurat',
        'show_title' => 'Show Kategorisurat',
        'inputs' => [
            'id' => 'Id',
            'nama_kategori' => 'Nama Kategori',
            'keterangan' => 'Keterangan',
        ],
    ],

    'arsips' => [
        'name' => 'Arsips',
        'index_title' => 'Arsips List',
        'new_title' => 'New Arsip',
        'create_title' => 'Create Arsip',
        'edit_title' => 'Edit Arsip',
        'show_title' => 'Show Arsip',
        'inputs' => [
            'id' => 'Id',
            'nomor_surat' => 'Nomor Surat',
            'judul' => 'Judul',
            'kategorisurat_id' => 'Kategorisurat',
            'flie_path' => 'Flie Path',
            'waktu_pengarsipan' => 'Waktu Pengarsipan',
        ],
    ],
];
