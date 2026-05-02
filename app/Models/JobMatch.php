<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobMatch extends Model
{
    protected $fillable = [
        'user_id',
        'cv_id',
        'job_description',
        'match_result'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cv()
    {
        return $this->belongsTo(CV::class);
    }
}