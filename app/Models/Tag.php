<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $keyType = 'string';

    public $primaryKey = 'id';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function ProductTag()
    {
        // return $this->belongsTo('App\Models\ProductTag', 'id', 'tag_id');
        return $this->belongsTo(ProductTag::class);
    }
}
