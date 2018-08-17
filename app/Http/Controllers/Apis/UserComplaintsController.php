<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Auth;
use Validator;

class UserComplaintsController extends Controller
{
    public function index(Request $request)
    {
    	$user = User::find(Auth::guard('api')->id());

    	if (! $user) 
    	{
    		return response()->json([

    			'status'    => false,
    			'code'      => 401,
    			'api_token' => "User is not Registered"
    		]);
    	} 

    	$validate = Validator::make($request->all(),[

    		'user_id' 	  	=> 'required',
    	]);

    	if ($validate->fails()) 
    	{
    		return response()->json([

    			'success' => 'false',
    			'status'  => '401',
    			'message' => 'User Id Required',
    			'errors'  => $validate->errors()
    		]);
    	}

    	$complaint_details = DB::table('user_complaint_register')->where('user_id',$request->user_id)->first();

		if ($complaint_details) 
		{
			return response()->json([

	    			'success' => 'true',
	    			'status'  => '200',
	    			'message' => 'User Complaint Details',
	    			'complaint_detail'  => $complaint_details
	    		]);    	
		} 
		else 
		{
			return response()->json([

	    			'success' => 'false',
	    			'status'  => '401',
	    			'message' => 'User Complaint Details not Found',
	    		]); 
		}
		

    }
}
