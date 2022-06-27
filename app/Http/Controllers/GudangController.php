<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;
use App\Models\Customer;
// use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Role;
use Illuminate\Support\Facades\Session;
use App\Models\Useraccess;
use App\Models\Listaccess;
use App\Http\Controllers\HelpersController as Helpers;
use App\Http\Controllers\AlamatController as Calamat;
use App\Models\Alamat;
use App\Models\List_user_gudang;
use App\Models\Loc_city;
use App\Models\Loc_district;
use App\Models\Loc_province;
use App\Models\Loc_village;
use Auth;
use Illuminate\Support\Facades\Validator;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        // $coba = Gudang::all();
        // dd($coba);
        $user = User::where('id', '!=', 0)->get();
        // dd($user);

     $alamat = Loc_province::where('id', '!=', 0)->get();
   
        // dd($coba);
    //     return view("gudang.index",['title'=> "Gudang"], compact('user'),array(
    //         'datas'  => array(
    //             'alamat' => $alamat
    //             // 'user' => $user
    //         )


    //  $alamat = Loc_province::where('id', '!=', 0)->get();
   
     // dd($coba);
     return view("gudang.index", compact('user'),array(
         'datas'  => array(
             'user' => $user
         )
         ));
            // ));

        // return view('gudang.index');
    }
    public function gudanggetdata(Request $request){
        if($request->nama != null || $request->alamat != null|| $request->alias_gudang != null|| $request->active != null) {
            $whereraw = '';
            if($request->nama != null) $whereraw .= " and nama like '%$request->nama%'";
            if($request->alamat != null) $whereraw .= " and alamat like '%$request->alamat%'";
            if($request->alias_gudang != null) $whereraw .= " and alias_gudang like '%$request->alias_gudang%'";
            if($request->active != null) $whereraw .= " and active like '%$request->active%'";


    		$whereraw = preg_replace('/ and/', '', $whereraw, 1);
    		$users = Gudang::whereRaw($whereraw)->get();    	

    	} else {
    		$users = Gudang::get();
    	}
        // dd($users);

    	$datas = [];
		foreach($users as $key => $user){
    		$datas[$key] = [
    			'', $user->nama,$user->alamat,$user->alias_gudang,$user->active,$user->flag_delete,$user->id
    		];
    	}

    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    // nama	divisi alias_gudang id_product user active active	
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
      
            'nama' => 'required',
            'alias_gudang' => 'required',
            'alamat' => 'required',
          
        ],[
         'nama.required' => 'Nama Gudang Tidak Boleh Kosong',
         'alias_gudang.required' => 'Alias Gudang  Tidak Boleh Kosong',
         'alamat.required' => 'Alamat Tidak Boleh Kosong',
         
        ]);
         
        if ($validator->fails()) {
         return response()->json(['errors'=>$validator->errors()->all()]);
     }

     $datas = new Gudang();
     $datas->nama = $request->nama;
     $datas->alias_gudang = $request->alias_gudang;
     $datas->alamat = $request->alamat;
     $datas->active = $request->active;

    if($datas->save());{
        $gudang = new List_user_gudang;
        $gudang->id_gudang = $datas->id;
        
    }
                    
     return response()->json(['data' => ['success'], 'status' => '200'], 200);

    }
    public function getchangeuser(Request $request, $id){

        $users = User::where('id', $id)->get();
        // dd($users);
        return response()->json(['data' => $users, 'status' => '200'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function show(Gudang $gudang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Gudang $gudang)
    {
        $datas = Gudang::where('id', $id)->get();

        return response()->json(['data' => $datas, 'status' => '200'], 200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gudang $gudang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gudang $gudang, Request $request, $id)
    {
        $datas = Gudang::where('id',$id)->first();
        $datas->flag_delete = 1;

        if(isset($request->undeleted)) $datas->flag_delete = 0;
        $datas->save();
    
        return response()->json(['data' => $datas, 'status' => '200'], 200);;
    }
}
