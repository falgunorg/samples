<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $guarded = [];
  protected $fillable = ['name', 'slug', 'img'];

    public function samples() {
        return $this->hasMany(Sample::class);
    }
}
