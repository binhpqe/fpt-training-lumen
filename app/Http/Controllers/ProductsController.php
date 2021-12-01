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
        //return response()->json(    Products::all() );
        //$exec = Products::table('products') -> get();
        $exec = Products::where('is_deleted',0) 
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
        $exec = Products::find($id);
        
        $exec = DB::table('products')
                                ->where('product_id',$id)
                                ->update(   ['is_deleted' => 1, 'is_new' => 1]  );
        //$results = DB::select("SELECT * FROM users");
        //$exec -> update( $request->all() );
        return respone() -> json($exec,200);
        //dd($exec);
    }
}
