<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $keyType = 'string';

    public $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'name',
        'slug',
        'cover',
    ];
}
