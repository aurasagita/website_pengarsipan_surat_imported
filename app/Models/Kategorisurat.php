<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategorisurat extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama_kategori', 'keterangan'];

    protected $searchableFields = ['*'];

    public function arsips()
    {
        return $this->hasMany(Arsip::class);
    }
}
