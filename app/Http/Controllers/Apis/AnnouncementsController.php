<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AnnouncementsController extends Controller
{
    public function index()
    {
        $Announcements = DB::table('announcements')->orderBy('id','desc')->get();

    	return response()->json([

                'success' => 'true',
                'status'  => 200,
                'message' => 'Announcements',
                'announcements' => $Announcements,
        	]);
    }
}
