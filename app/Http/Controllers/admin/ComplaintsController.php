<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading']    = 'All Complaints';
        $data['complaints'] = DB::table('user_complaint_register')
                                    ->join('users','users.id','=','user_complaint_register.user_id')    
                                    ->join('complaint_status','complaint_status.id','=','user_complaint_register.status_id')    
                                    ->get();
        // dd($data['complaints']);
         return view('admin.complaints.all_complaints')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function pending()
    {
        $data['heading']    = 'Pending Complaints';
        $data['pending_complaints'] = DB::table('user_complaint_register')
                                    ->join('users','users.id','=','user_complaint_register.user_id')    
                                    ->join('complaint_status','complaint_status.id','=','user_complaint_register.status_id')   
                                    ->where('status_id',1) 
                                    ->get();
        // dd($data['complaints']);
         return view('admin.complaints.pending')->with($data);
    }
    public function inprogress()
    {
        $data['heading']    = 'Inprogress Complaints';
        $data['inprogress_complaints'] = DB::table('user_complaint_register')
                                    ->join('users','users.id','=','user_complaint_register.user_id')    
                                    ->join('complaint_status','complaint_status.id','=','user_complaint_register.status_id')   
                                    ->where('status_id',3) 
                                    ->get();
        
         return view('admin.complaints.inprogress')->with($data);
    }
    public function irrelevant()
    {
        $data['heading']    = 'Irrelevant Complaints';
        $data['irrelevant_complaints'] = DB::table('user_complaint_register')
                                    ->join('users','users.id','=','user_complaint_register.user_id')    
                                    ->join('complaint_status','complaint_status.id','=','user_complaint_register.status_id')   
                                    ->where('status_id',4) 
                                    ->get();
        
         return view('admin.complaints.irrelevant')->with($data);
    }
    public function not_understandable()
    {
        $data['heading']    = 'Not Understandable Complaints';
        $data['not_understandable_complaints'] = DB::table('user_complaint_register')
                                    ->join('users','users.id','=','user_complaint_register.user_id')    
                                    ->join('complaint_status','complaint_status.id','=','user_complaint_register.status_id')   
                                    ->where('status_id',5) 
                                    ->get();
        
         return view('admin.complaints.not_understandable')->with($data);
    }
    public function completed()
    {
        $data['heading']    = 'Completed Complaints';
        $data['completed_complaints'] = DB::table('user_complaint_register')
                                    ->join('users','users.id','=','user_complaint_register.user_id')    
                                    ->join('complaint_status','complaint_status.id','=','user_complaint_register.status_id')   
                                    ->where('status_id',2) 
                                    ->get();
        
         return view('admin.complaints.completed')->with($data);
    }
}
