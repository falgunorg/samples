<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleType extends Model {

    protected $guarded = [];
    protected $fillable = ['name'];

    public function samples() {
        return $this->hasMany(Sample::class);
    }
}
