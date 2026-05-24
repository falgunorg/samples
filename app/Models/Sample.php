<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model {

    protected $guarded = [];

    public function buyer() {
        return $this->belongsTo(Buyer::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function sampleType() {
        return $this->belongsTo(SampleType::class);
    }

    public function itemType() {
        return $this->belongsTo(ItemType::class);
    }

    public function images() {
        return $this->hasMany(SampleImage::class);
    }

    public function inquiries() {
        return $this->hasMany(Inquiry::class);
    }
}
