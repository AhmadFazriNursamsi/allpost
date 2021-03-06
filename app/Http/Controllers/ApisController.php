<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Division;
use App\Models\Role;
use App\Http\Controllers\HelpersController as Helpers;
use Auth;
use Illuminate\Support\Facades\Validator;
class ApisController extends AController
{
    public function apigetdatauser(Request $request){
    	$this->access = Helpers::checkaccess('users', 'view');
        if(!$this->access) return response()->json(['data' => $datas, 'status' => '401'], 200);


    	$users = User::with('divisions', 'roles');
    	if($request->name != null || $request->email != null || $request->division != null || $request->username != null || $request->role != null || $request->mobile != null || $request->active != null) {
    		$whereraw = '';

    		if($request->name != null) $whereraw .= " and name like '%$request->name%'";
    		if($request->username != null) $whereraw .= " and username like '%$request->username%'";
    		if($request->email != null) $whereraw .= " and email like '%$request->email%'";
    		if($request->mobile != null) $whereraw .= " and mobile like '%$request->mobile%'";
    		if($request->role != null) $whereraw .= " and id_role = $request->role";
    		if($request->active != null) $whereraw .= " and active = $request->active";
    		if($request->division != null) $whereraw .= " and id_division = $request->division";

    		$whereraw = preg_replace('/ and/', '', $whereraw, 1); // replace first and
    		$users = $users->whereRaw($whereraw)->where('id_role', '!=', 99)
    		->get();    	

    	} else {
    		$users = $users->where('id_role', '!=', 99)->get();
    	}

    	$datas = [];
    	foreach($users as $key => $user){
    		$datas[$key] = [
    			'', $user->name, $user->username, $user->email, $user->division, $user->roles->role_name, $user->mobile, $user->active, $user->id, $user->flag_delete
    		];
    	}

    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }



	///Getdata devision
	public function apigetdatadivi(Request $request){
    	$this->access = Helpers::checkaccess('divisions', 'view');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);


		$users = User::with('divisions', 'roles');
    	$coba = Division::with('roles');
		if($request->division != null || $request->active != null||$request->name != null || $request->email != null || $request->username != null || $request->role != null || $request->mobile != null) {
    		$whereraw = '';

    		if($request->division != null) $whereraw .= " and id_division = $request->division";
    		if($request->active != null) $whereraw .= " and active = $request->active";
    		if($request->name != null) $whereraw .= " and name like '%$request->name%'";
    		if($request->username != null) $whereraw .= " and username like '%$request->username%'";
    		if($request->email != null) $whereraw .= " and email like '%$request->email%'";
    		if($request->mobile != null) $whereraw .= " and mobile like '%$request->mobile%'";
    		if($request->role != null) $whereraw .= " and id_role = $request->role";

    		$whereraw = preg_replace('/ and/', '', $whereraw, 1); // replace first and
    		$users = $users->whereRaw($whereraw)->where('id_role', '!=', 99)
    		->get();    	

    	} else {
    		$users = $users->where('id_role', '!=', 99)->get();
    	}
		$coba2 = Division::all();
    	

    	$datas = [];
    	// foreach($coba as $key => $user){
    	// 	$datas[$key] = [
    	// 		'', $user->division_name,$user->id_division,$user->active,
    	// 	];
    	// }

		foreach($coba2 as $key => $user){
    		$datas[$key] = [
    			'', $user->division_name,$user->active,$user->id_division
    		];
    	}

    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    public function apigetdivisi(Request $request){
    	$this->access = Helpers::checkaccess('divisi', 'view');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);

    	$datas = Division::get();
    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    public function apigetrole(Request $request){
    	$this->access = Helpers::checkaccess('role', 'view');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);

    	$datas = Role::where("id_role", "!=", 99)->get();
    	return response()->json(['data' => $datas, 'status' => '200'], 200);
    }

    public function apideleteuserbyid($id, Request $request){

    	$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

    	$datas = User::where('id', $id)->first();
    	
    	$datas->flag_delete = 1;
    	$datas->save();

    	echo 'success';
    }

	public function store(Request $request){

		// dd($request->division_name);
		$this->access = Helpers::checkaccess('divisions', 'create');
        if(!$this->access) return response()->json(['data' => [], 'status' => '401'], 200);

		$validatedData = $request->validateWithBag('post', [
			'division_name' => ['required','unique:division'],
			'active' => ['required'],
		]);
 

        Division::updateOrCreate($validatedData); 
                         
		return response()->json(['success', 'Data Berhasil Disimpan']);
	}
	public function detail($id, Request $request){

        $datas  = Division::where('id_division', $id)->first();
      
        return response()->json(['data' => $datas, 'status' => '200'], 200);
		// $datas = Division::where('id_division', $id_division)->first();

        // return Response()->json($datas);
		// $datas = Division::where('id_division', $id)->first();
		// $where = array('id_division' => $request->id_division);
        // $company  = Division::where($where)->first();
      
        // return Response()->json($datas);
		// return $request;
	
    }

	public function destroy($id, Request $request)
    {
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

		$datas = Division::where('id_division',$id)->delete();
        // $datas  = Division::where('id_division', $id)->first();
      
        return response()->json(['data' => $datas, 'status' => '200'], 200);;
    }

	public function apiEdit($id, Request $request)
    {
		// dd($request->division_name,$request->active);
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

		$datas  = Division::where('id_division', $id)->first();


      
        // return response()->json(['data' => $datas, 'status' => '200'], 200)
      
        return response()->json(['data' => $datas, 'status' => '200'], 200);;
    }
	public function update2($id, Request $request)
    {
		// dd($request->division_name_edit,$request->active);
		

		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);
		
		// $request->validateWithBag('post', [
		// 		'division_name_edit' => ['required','unique:division'],
		// 	'active_edit' => ['required'],
		// ]);
		
		$validatedData = $request->validateWithBag('post', [
			'division_name' => ['required','unique:division'],
			'active' => ['required'],
		]);

		Division::updateOrCreate($validatedData); 


    }
	public function update3($id, Request $request)
    {
		// dd($request->request);
		$this->access = Helpers::checkaccess('users', 'delete');
        if(!$this->access) return response()->json(['data' => ['false'], 'status' => '401'], 200);

		$validator = Validator::make($request->all(), [
			'division_name' => 'required|unique:division',
			'active' => 'required',
			// 'name_url' => 'required'
		]);
		 
		if ($validator->fails()) {
			 return response()->json(['data' => ['fails'], 'status' => '401'], 200);
		}
 
		$datas = Division::where('id_division', $id)->first();
        $datas->division_name = $request->division_name;
        $datas->active = $request->active;

        if($datas->save())
            return response()->json(['data' => ['success'], 'status' => '200'], 200);
        else 
            return response()->json(['data' => ['fails'], 'status' => '200'], 200);
	
	}

}
