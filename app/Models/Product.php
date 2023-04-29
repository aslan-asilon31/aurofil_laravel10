<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $keyType = 'string';

    public $primaryKey = 'id';

    use HasFactory;

    protected $fillable = [
        'name', 
        'slug',
        'price',
        'quantity',
        'description',
        'details',
        'weight',
        'category_id',
    ];

    // public function getGalleryAttribute()
    // {
    //     return $this->getMedia('gallery');
    // }

    public function category() {
        // return $this->belongsTo('App\Models\Category', 'product_id', 'id');
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
