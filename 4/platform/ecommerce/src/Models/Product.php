<?php

namespace Demo\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'product';
    // Primary Key
    public $primaryKey = 'product_id';

    /**
     * @var array
     */
    protected $fillable = [
        'product_name',
        'product_content',
        'category_id',
        'product_slug',
        'price',
        'description',
        'image',
        'is_featured',
        'status',
    ];


    public function category(){
        return $this->hasOne('Demo\Ecommerce\Models\Category','category_id','category_id');
    }
}
