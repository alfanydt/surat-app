<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'surat_id', 'komentar', 'user_id'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
