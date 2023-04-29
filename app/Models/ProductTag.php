<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    protected $table = 'product_tag';

    protected $keyType = 'string';

    public $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'tag_id',
    ];

    public function product() {
        // return $this->hasOne('App\Models\Product', 'product_id', 'id');
        return $this->hasOne(Product::class);
    }

    public function tag() {
        // return $this->hasOne('App\Models\Tag', 'tag_id', 'id');
        return $this->hasOne(Tag::class);
    }

}
