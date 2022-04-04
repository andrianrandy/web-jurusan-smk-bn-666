<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori', 'slug'
    ];

    public function artikel()
    {
        return $this->hasMany(Artikel::class);
    }

    protected $hidden = [];
}
