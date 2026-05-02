<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'user_id',
        'cv_id',        // ✅ IMPORTANT (ajouté)
        'question',
        'answer',
        'feedback',
        'score'
    ];

    // ✅ relation avec CV
    public function cv()
    {
        return $this->belongsTo(CV::class);
    }

    // ✅ relation avec User (bonne pratique)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}