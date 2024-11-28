<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arsip extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'nomor_surat',
        'judul',
        'flie_path',
        'waktu_pengarsipan',
        'kategorisurat_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'waktu_pengarsipan' => 'datetime',
    ];

    public function kategorisurat()
    {
        return $this->belongsTo(Kategorisurat::class);
    }
}
