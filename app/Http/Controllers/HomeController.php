<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_complants'] = DB::table('user_complaint_register')
                                     ->select(DB::raw('count(*) AS all_complants'))
                                     ->first();
                                     
        $data['pending_complaints'] = DB::table('user_complaint_register')
                                     ->select(DB::raw('count(*) AS pending_complaints'))
                                     ->where('complaint_status','=','Pending')
                                     ->first();
        // dd($data['all_complants']);
        $data['completed_complaints'] = DB::table('user_complaint_register')
                                     ->select(DB::raw('count(*) AS completed_complaints'))
                                     ->where('complaint_status','=','Completed')
                                     ->first();
        $data['in_progress_complaints'] = DB::table('user_complaint_register')
                                     ->select(DB::raw('count(*) AS in_progress_complaints'))
                                     ->where('complaint_status','=','In Progress')
                                     ->first();
        $data['irrelevant_complaints'] = DB::table('user_complaint_register')
                                     ->select(DB::raw('count(*) AS irrelevant_complaints'))
                                     ->where('complaint_status','=','Irrelevant')
                                     ->first();
        $data['not_understandable_complaints'] = DB::table('user_complaint_register')
                                     ->select(DB::raw('count(*) AS not_understandable_complaints'))
                                     ->where('complaint_status','=','Not Understandable')
                                     ->first();
        $data['all_districts'] = DB::table('districts')
                                     ->select(DB::raw('count(*) AS all_districts'))
                                     ->first();
        $data['announcements'] = DB::table('announcements')
                                     ->select(DB::raw('count(*) AS announcements'))
                                     ->first();
        // dd($data['announcements']);
        // $data['pending_complaints'] = DB::table('user_complaint_register')
        //                              ->select(DB::raw('count(*) AS pending_complaints'))
        //                              ->where('complaint_status','=','Pending')
        //                              ->first();

        return view('dashboard')->with($data);
    }
}
