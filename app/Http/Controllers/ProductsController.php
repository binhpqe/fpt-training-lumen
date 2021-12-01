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
    
    private  $Products ;
     
    public function __construct()
    {
       $this->Products = new Products;
    }

    /*
        Date Create: 2021-12-01 11:50:00
        Date Update: 2021-12-01 17:00:00
        Dev: Thien Binh
    */ 
    
    public function getProducts()
    {        
        return $this->Products->productsViewFullItem();
    }
    
    public function getProduct($id)
    {
        return $this->Products->productsViewChoosenItem($id);
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
        
        return $this->Products-> productInsertItem($request);
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
        
        return $this->Products-> productsUpdateItem($id,$request);
    }
    
    public function deleteProduct($id)
    {
        return $this->Products-> productsUpdateDeletedItem($id);
    }
    
    
    public function forceDeleteProduct($id)
    {
        
        return $this->Products-> productsDeleteItem($id);
    }
}
