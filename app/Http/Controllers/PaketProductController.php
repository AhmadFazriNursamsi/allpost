<?php

namespace App\Http\Controllers;

use App\Models\ListPaket;
use Illuminate\Http\Request;
use App\Models\Gudang;
// use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\HelpersController as Helpers;
use App\Http\Controllers\AlamatController as Calamat;
use App\Models\DetailPaket;
use App\Models\list_product;
use App\Models\List_user_gudang;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class PaketProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Helpers::satuan();
      
        return view('paket.index',array(
            'datas'  => array(
                'satuan' => $satuan,
                'title' => 'Gudang',
              
            )
            ));
    }
    public function getdata(){
        $paket = ListPaket::get();
        // dd($paket);
            $datas = [];
            $i = 1;
            foreach($paket as $key => $pakets){
                $datas[$key] = [
                   $i++, $pakets->nama, $pakets->id
                ];
            }
    
            return response()->json(['data' => $datas, 'status' => '200'], 200);
    
    
    }
    public function autocomplete(Request $request)
    {

        
        $p = $request->get('query');
        $data = Product::select("nama")
                ->where('nama','LIKE',"%{$p}%")
                ->get();
   
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function auto($id)
    {
        $datas = Product::where('id', $id)->get();


        return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $datas = new ListPaket();
        $datas->nama = $request->nama;
        $datas->created_at = date('Y-m-d H:i:s');

        if($datas->save()){
        $products = Product::get();
        // dd($products);
        foreach($products as $product){
            $listProduct = DetailPaket::where('id_list_paket', $datas->id)->where('id_product', $product->id)->first();
            // dd($listProduct);
            if(isset($listProduct->id)) continue;
            else{
                $listProduct = new DetailPaket;

                // dd($listProduct);
                
                $listProduct->id_list_paket =$datas->id;
                $listProduct->id_product =$product->id;
                $listProduct->satuan = $product->satuan;
                $listProduct->created_at = date('Y-m-d H:i:s');
               $listProduct->save();
            }
        }
    }
        return response()->json(['data' => ['success'], 'status' => '200'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListPaket  $listPaket
     * @return \Illuminate\Http\Response
     */
    public function show(ListPaket $listPaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListPaket  $listPaket
     * @return \Illuminate\Http\Response
     */
    public function edit(ListPaket $listPaket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListPaket  $listPaket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListPaket $listPaket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListPaket  $listPaket
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListPaket $listPaket)
    {
        //
    }
}
