<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AwarenessController extends Controller
{
    public function index()
    {
        $awareness = DB::table('awareness')->get();

    	return response()->json([

                'success' => 'true',
                'status'  => 200,
                'message' => 'Awareness Data',
                'awareness' => $awareness,
        	]);
    }
}
