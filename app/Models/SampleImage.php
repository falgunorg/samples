<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleImage extends Model
{
    protected $fillable = ['image_path', 'sample_id'];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}