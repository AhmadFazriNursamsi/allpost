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
    }


    public function alamatgetById($id, Request $request){

            $datas = Loc_province::where('id', $id)->get();

            return response()->json(['data' => $datas, 'status' => '200'], 200);

    
            }

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


    


    public static function alamatgetByIdCity2($id){

        $cities = Loc_city::where('id', $id )->get();
        
        $output = [];
        foreach( $cities as $city )
        {
           $output = $city->name;
        }
        return response()->json(['data' => $output, 'status' => '200'], 200);
    }

    public static function alamatgetByIdKab2($id){
        $cities = Loc_district::where('id', $id )->get();
        $output = [];
        foreach( $cities as $city )
        {
           $output = $city->name;
        }
        return response()->json(['data' => $output, 'status' => '200'], 200);
    }

    public static function alamatgetByIdKel2($id){
        $cities = Loc_village::where('id', $id )->get();
        $output = [];
        foreach( $cities as $city )
        {
           $output = $city->name;
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
