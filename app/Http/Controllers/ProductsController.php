<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*
        Date Create: 2021-12-01 11:50:00
        Date Update: *
        Dev: Thien Binh
    */ 
    
    public function getProducts()
    {
        $exec = Products::where('is_deleted',0) 
                            -> get();
        return $exec;
    }
    
    public function getProduct($id)
    {
        $exec = Products::where('product_id',$id) 
                            -> get();
        return $exec;
    }
    
    public function createProduct(Request $request)
    {
        /*Valid Check*/
        $this->validate($request, [
            'product_name_vi'           => 'required',
            'product_name_en'           => 'required',
            'icon_url'                  => 'required',
            'data_action_staging'       => 'required',
            'data_action_production'    => 'required',
            'action_type'               => 'required',
            'is_deleted'                => 'required|boolean',
            'is_new'                    => 'required|boolean'
        ]);
        
        /*Insert to DB*/
        $exec = Products::create($request -> all() );
        return response() -> json ($exec, 201);
    }
    
    public function updateProduct($id, Request $request)
    {
        /*Valid Check*/
        $this->validate($request, [
            'product_name_vi'           => 'max:50',
            'product_name_en'           => 'max:50',
            'icon_url'                  => 'max:255',
            'data_action_staging'       => 'max:255',
            'data_action_production'    => 'max:255',
            'action_type'               => '',
            'data'                      => '',
            'content'                   => 'max:255',
            'date_modified'             => 'date_format:Y-m-d H:i:s',
            'new_begin_day'             => 'date|before:new_end_day',
            'new_end_day'               => 'date|after:new_begin_date',
            'is_deleted'                => 'boolean',
            'is_new'                    => 'boolean'
        ]);
        
        
        $Products = new Products;
                
        $exec = Products::where('product_id',$id)
                            ->update($request -> all() );
                            
        return response() -> json("Da cap nhat du lieu",200);
    }
    
    public function deleteProduct($id)
    {
        
        /* -> Set is_new = 1 -> current record*/
        $exec = Products::where('product_id',$id)
                            ->update(['is_deleted' => 1] );
                            
        return response() -> json("Da cap nhat delete",200);
    }
    
    
    public function forceDeleteProduct($id)
    {
        
        /* -> Xoá luôn record*/
        $exec = Products::where('product_id',$id)
                            ->delete();
        return response() -> json("Da delete khoi db",200);
    }
}
