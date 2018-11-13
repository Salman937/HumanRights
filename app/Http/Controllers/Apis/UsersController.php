<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use Mail;
use App\Mail\Sendmail;
use DB;

class UsersController extends Controller
{
	public function index(Request $request)
	{
		$validator = Validator::make($request->all(), [

			'name' => 'required|string',
			'mobile_no' => 'required|unique:users,mobile_no',
			'cnic' => 'required|unique:users,cnic',
			'email' => 'required|unique:users,email',
			'city' => 'required',
			'password' => 'required',
			'device_token' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json([

				'success' => 'false',
				'status' => 401,
				'message' => "Please Review for All Fields",
				'errors' => $validator->errors()
			]);
		}

		$user = User::create([

			'name' => $request->name,
			'mobile_no' => $request->mobile_no,
			'cnic' => $request->cnic,
			'email' => $request->email,
			'city' => $request->city,
			'device_token' => $request->device_token,
			'password' => bcrypt($request->password),
			'api_token' => str_random(60),
			'verification_code' => str_random(6),
		]);

		Mail::send(new Sendmail($user));

		return response()->json([

			'success' => 'true',
			'status' => 200,
			'message' => 'We have send verification code to your email please check your email to verify your account',
			'user_data' => $user
		]);
	}

	public function verify_account(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'code' => 'required|string',
		]);

		if ($validator->fails()) {
			return response()->json([

				'success' => 'false',
				'status' => 401,
				'errors' => $validator->errors()
			]);
		}

		$user = DB::table('users')->where('verification_code', $request->code)->first();

		if (empty($user)) {
			return response()->json([

				'success' => 'false',
				'status' => 401,
				'message' => 'Please check your verification code. your verification code does not exits in our database'
			]);
		} else {
			return response()->json([

				'success' => 'true',
				'status' => 200,
				'user' => $user
			]);
		}
	}

	public function forgot_password(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json([

				'success' => 'false',
				'status' => 401,
				'errors' => $validator->errors()
			]);
		}

		$user = DB::table('users')->where('email', $request->email)->first();

		if (empty($user)) {
			return response()->json([

				'success' => 'false',
				'status' => 401,
				'message' => 'Please check your Email. Your Email does not exits in our database'
			]);
		} else {
			$update_user = DB::table('users')
				->where('email', $user->email)  // find your user by their email
				->limit(1)  // optional - to ensure only one record is updated.
				->update(array('verification_code' => str_random(6)));  // update the record in the DB.

			return response()->json([

				'success' => 'ture',
				'status' => 200,
				'user' => $user
			]);
		}
	}

	public function verify_forgot_password(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'code' => 'required|string',
		]);

		if ($validator->fails()) {
			return response()->json([

				'success' => 'false',
				'status' => 401,
				'errors' => $validator->errors()
			]);
		}

		$user = DB::table('users')->where('verification_code', $request->code)->first();

		if (empty($user)) {
			return response()->json([

				'success' => 'false',
				'status' => 401,
				'message' => 'Please check your verification code. your verification code does not exits in our database'
			]);
		} else {
			return response()->json([

				'success' => 'false',
				'status' => 200,
				'user' => $user
			]);
		}
	}
}
