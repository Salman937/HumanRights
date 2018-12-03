<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PhoneDirController extends Controller
{
    public function index()
    {
        $phone_dir = DB::table('phone_dir')->orderBy('id','desc')->get();

    	return response()->json([

                'success' => 'true',
                'status'  => 200,
                'message' => 'Phone Dirctory',
                'phone_dir' => $phone_dir,
        	]);
    }
}
