<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    
    protected $fillable = [
        'product_name_vi',
        'product_name_en',
        'icon_url',
        'data_action_staging',
        'data_action_production',
        'action_type',
        'data',
        'content',
        'date_modified',
        'new_begin_day',
        'new_end_day',
        'is_deleted',
        'is_new'
    ];

    /*
        Remove update_at & create_at in default of Laravel
        Reference link: https://laravel.com/docs/8.x/eloquent#timestamps
    */
    public $timestamps = false;
    
    /*
        Set primaryKey of Table Model
        Reference link: https://laravel.com/docs/8.x/eloquent#primary-keys
    */
    protected $primaryKey = 'product_id';
}
