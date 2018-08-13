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

	    		'mobile_no'  => 'required',
	    		'password' 	 => 'required',

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

	    	if(Auth::attempt([ 'mobile_no' => $request->mobile_no , 'password' => $request->password]))
	    	{
	    		//Authentication passed
	    		
	    		$user = Auth::user();
	    		
	    		// $user->save();

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
	    			'message'   => 'Your Mobile Number OR Password might be Incorrect',
	    		]);
	    	}	
    }
}
