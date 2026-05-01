<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
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
