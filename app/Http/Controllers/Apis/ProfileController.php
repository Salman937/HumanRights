<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = DB::table('users')->where('id', $request->user_id)->first();

        if (!empty($user)) {
            $new_arr = array(

                'id' => $user->id,
                'name' => $user->name,
                'mobile_no' => $user->mobile_no,
                'cnic' => $user->cnic,
                'email' => $user->email,
                'city' => $user->city,
            );

            return response()->json([

                'success' => 'true',
                'status' => '200',
                'message' => 'user profile data',
                'user' => $new_arr
            ]);
        } else {
            return response()->json([

                'success' => 'false',
                'status' => '401',
                'message' => 'This id have data in our records',
            ]);
        }
    }

    public function update(Request $request)
    {
        if (empty($request->password)) {
            DB::table('users')->where('id', $request->user_id)->update([

                'mobile_no' => $request->mobile_no,
                'city'      => $request->city,
                'email'     => $request->email,
                'address'   => $request->address,
            ]);

            return response()->json([

                'success' => 'true',
                'status' => '200',
                'message' => 'user updated successfully',
            ]);
        } else {
            DB::table('users')->where('id', $request->user_id)->update([

                'mobile_no' => $request->mobile_no,
                'city'      => $request->city,
                'email'     => $request->email,
                'address'   => $request->address,
                'password'   => bcrypt($request->password),
            ]);

            return response()->json([

                'success' => 'true',
                'status' => '200',
                'message' => 'user updated successfully',
            ]);
        }

    }
}
