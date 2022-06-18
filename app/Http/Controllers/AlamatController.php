<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Loc_city;
use App\Models\Loc_district;
use App\Models\Loc_province;
use App\Models\Loc_village;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $divisions = Division::where('active', 1)->get();
        // $roles = Role::where('active', 1)->where('id_role', '!=', 99)->get();
        // $user_access = Listaccess::where('flag_delete', 0)->get();

    	// return view('users.create', array(
        //     'datas'  => array(
        //         'users' => array(),
        //         'divisions' => $divisions,
        //         'roles' => $roles,
        //         'user_access' => $user_access,
        //         'urls' => 'store/',
        //         // 'urls' => 'update/'.$id,
        //     ),
        //     'id' => ''
        // ));
    }


    public function alamatgetById($id,$departmentid= 0, Request $request){
            // Fetch department
            
            
    	// Fetch Employees by Departmentid
        // $empData['data'] = Loc_district::orderby("name")
        // 			->select('id','name')
        // 			->where('Loc_province:',$departmentid)
        // 			->get();
  
        //             return response()->json($empData);
     

            // return "asdsadasd";
            $datas = Loc_province::where('id', $id)->get();

            return response()->json(['data' => $datas, 'status' => '200'], 200);

        //     $empData['data'] = Loc_city::orderby("name","asc")
        //     ->select('id','name')
        //     ->where('id',$id)
        //     ->get();

        //     return response()->json($empData);
        // }

        // $koneksi = Loc_province::get();
        // // $query = mysqli_query($koneksi, "SELECT * FROM tbl_jakarta ORDER BY country_id");

        // // $datas = Loc_province::where('id', $id)->get();
        // $output = '<option value="">--Pilih Provinsi--</option>';
        //     while($row = mysqli_fetch_array($koneksi)){
        //         $output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
            }
        //     return response()->json(['data' => $output, 'status' => '200'], 200);
            // echo $output;

        // $datas = Loc_province::where('id', $id)->get();

    public function alamatgetByIdCity(Request $request){

        $this->validate( $request, [ 'id' => 'required' ] );
        $cities = Loc_city::where('province_id', $request->get('id') )->get();
        $output = [];
        foreach( $cities as $city )
        {
           $output[$city->id] = $city->name;
        }
        return response()->json(['data' => $output, 'status' => '200'], 200);
    }

    public function alamatgetByIdKab(Request $request){
        $this->validate( $request, [ 'id' => 'required' ] );
        $cities = Loc_district::where('city_id', $request->get('id') )->get();
        $output = [];
        foreach( $cities as $city )
        {
           $output[$city->id] = $city->name;
        }
        return response()->json(['data' => $output, 'status' => '200'], 200);
    }

    public function alamatgetByIdKel(Request $request){
        $this->validate( $request, [ 'id' => 'required' ] );
        $cities = Loc_village::where('district_id', $request->get('id') )->get();
        $output = [];
        foreach( $cities as $city )
        {
           $output[$city->id] = $city->name;
        }
        return response()->json(['data' => $output, 'status' => '200'], 200);
    }




    public function alamatgetByIdDistrict($id, Request $request){

        $datas = Loc_district::where('id', $id)->get();

        return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    public function alamatVillage($id, Request $request){

        $datas = Loc_village::where('id', $id)->get();

        return response()->json(['data' => $datas, 'status' => '200'], 200);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function show(Alamat $alamat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function edit(Alamat $alamat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alamat $alamat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alamat $alamat)
    {
        //
    }
}
