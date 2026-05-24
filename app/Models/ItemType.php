<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
      protected $guarded = [];

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }
}
