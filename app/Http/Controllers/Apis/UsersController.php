<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Mail;
use App\Mail\Sendmail;

class UsersController extends Controller
{
	public function index(Request $request)
	{
	    $validator = Validator::make($request->all(),[

		    'name'    	  => 'required|string',
		    'mobile_no'   => 'required|unique:users,mobile_no',
		    'cnic' 		  => 'required|unique:users,cnic',
		    'email'       => 'required|unique:users,email',
		    'city'        => 'required',
		    'password'    => 'required',
		]);

		if ($validator->fails()) 
		{
		    return response()->json([

		        'success' => 'false',
		        'status'  => 401,
		        'message' => "Please Review for All Fields",
		        'errors'  => $validator->errors()
		    ]);
		} 

		$user = User::create([

			            'name'        => $request->name,
			            'mobile_no'   => $request->mobile_no,
			            'cnic'  	  => $request->cnic,
			            'email' 	  => $request->email,
			            'city'        => $request->city, 
			            'password'    => bcrypt($request->password), 
			            'api_token'   => str_random(60), 
			            'verification_code'   => str_random(6), 
		]);
		
		Mail::send(new Sendmail($user));

        return response()->json([

            'success'   => 'true',
            'status'    => 200,
            'message'   => 'User Created Succssfully',
            'user_data' => $user
        ]);
	}
}
