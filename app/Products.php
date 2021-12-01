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
    
    protected $table = 'products';
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
    
    
    /*Code with DB*/
    
    public function productsViewFullItem()
    {
        
        $exec = Products::where('is_deleted',0) 
                            -> get();
        return $exec;
    }
    
    public function productsViewChoosenItem($id)
    {
        $exec = Products::where('product_id',$id) 
                            -> get();
        return $exec;
    }
    
    
    public function productInsertItem($request)
    {
        $exec = Products::create($request -> all() );
        return response() -> json ($exec, 201);
    }
    
    public function productsUpdateItem($id, $request)
    {     
        $exec = Products::where('product_id',$id)
                            ->update($request -> all() );
                            
        return response() -> json("Da cap nhat du lieu",200);
    }
    
    public function productsUpdateDeletedItem($id)
    {
        
        /* -> Set is_new = 1 -> current record*/
        $exec = Products::where('product_id',$id)
                            ->update(['is_deleted' => 1] );
                            
        return response() -> json("Da cap nhat delete",200);
    }
    
    
    public function productsDeleteItem($id)
    {
        
        /* -> Xoá luôn record*/
        $exec = Products::where('product_id',$id)
                            ->delete();
        return response() -> json("Da delete khoi db",200);
    }
}
