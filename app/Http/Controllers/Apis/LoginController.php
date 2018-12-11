<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Auth;


class LoginController extends Controller
{
    public function index(Request $request)
    {
    	$validator = Validator::make($request->all(),[

	    		'cnic'  	 => 'required',
				'password' 	 => 'required',
				'device_token' => 'required',
	    	]);


	    	if ($validator->fails()) 
	    	{
	    		return response()->json([

	    			'success' => 'false',
	    			'status'  => '401',
	    			'message' => 'Please Review All Fields',
	    			'errors'  => $validator->errors()
	    		]);
	    	} 

	    	if(Auth::attempt([ 'cnic' => $request->cnic , 'password' => $request->password]))
	    	{
	    		//Authentication passed
	    		$user = Auth::user();
				
				$user->device_token = $request->device_token;	

	    		$user->save();

	    		return response()->json([
	    			'success'   => 'true',
	    			'status'    => '200',
	    			'message'   => 'User LoggedIn Successfully',
	    			'user_data' => $user
	    		]);
	    	}
	    	else
	    	{
	    		return response()->json([
	    			'success'   => 'false',
	    			'status'    => '401',
	    			'message'   => 'Your CNIC OR PASSWORD might be Incorrect',
	    		]);
	    	}	
    }
}
