<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [ 'id' ];

    public function pinjams()
    {
        return $this->hasMany(Pinjam::class, 'judul', 'judul');
    }
}

