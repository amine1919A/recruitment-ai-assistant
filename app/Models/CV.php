<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    // 🔥 AJOUT IMPORTANT
    protected $table = 'cvs';

    protected $fillable = [
        'user_id',
        'file_path',
        'analysis'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}