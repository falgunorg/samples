<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model {

    protected $fillable = [
        'user_id', 'company_id', 'buyer_id', 'po', 'season', 'style',
        'category_id', 'name', 'color', 'size_range', 'sample_type_id',
        'qty', 'tag', 'location', 'featured', 'status'
    ];
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

    public function images() {
        return $this->hasMany(SampleImage::class);
    }

    public function inquiries() {
        return $this->hasMany(Inquiry::class);
    }
}
