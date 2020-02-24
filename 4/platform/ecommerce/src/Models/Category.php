<?php

namespace Demo\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category';
    // Primary Key
    public $primaryKey = 'category_id';

    /**
     * @var array
     */
    protected $fillable = [
        'category_name',
        'category_slug',
        'parent_id',
        'category_status',
        'description'
    ];


    public function query_build ($param_name) {
        $query_ct = "
            WITH RECURSIVE tmp as ( 
                SELECT 
                    ct.*
                FROM category ct 
                WHERE ct.category_name like '%$param_name%'
                AND deleted_at IS NULL
            ), children as (
                SELECT 
                    ct.* 
                FROM category ct 
                JOIN tmp ON tmp.category_id = ct.category_id
                AND ct.deleted_at IS NULL
              UNION
                SELECT 
                    cte.* 
                FROM category cte, children 
                WHERE children.category_id = cte.parent_id
            ), parent as (
                SELECT 
                    ct.* 
                FROM category ct 
                JOIN tmp ON tmp.category_id = ct.category_id
                AND ct.deleted_at IS NULL
              UNION
                SELECT 
                    cte.* 
                FROM category cte, parent 
                WHERE parent.parent_id = cte.category_id
            )
            SELECT * FROM children
            UNION
            SELECT * FROM parent
            
            ;
    
        ";


        return $query_ct;
    }

    public function query_get_child_cate ($param_name) {
        $query_ct = "
            WITH RECURSIVE tmp as ( 
                SELECT 
                    ct.* 
                FROM category ct 
                WHERE ct.category_name like '%$param_name%'
                AND deleted_at IS NULL
              UNION
                SELECT 
                    cte.* 
                FROM category cte, tmp 
                WHERE tmp.category_id= cte.parent_id 
            ) 
            SELECT * FROM tmp;
    
        ";
        return $query_ct;
    }
}
