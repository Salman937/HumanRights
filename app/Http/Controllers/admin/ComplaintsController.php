<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading'] = 'All Complaints';
        $data['complaints'] = DB::table('user_complaint_register')
            ->select('user_complaint_register.id as complaint_id', 'users.*', 'complaint_status.*', 'user_complaint_register.*')
            ->join('users', 'users.id', '=', 'user_complaint_register.user_id')
            ->join('complaint_status', 'complaint_status.id', '=', 'user_complaint_register.status_id')
            ->get();

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
        $data['heading'] = 'Edit Complaint';
        $data['complaint_status'] = DB::table('complaint_status')->get();
        $data['complaint'] = DB::table('user_complaint_register')
            ->where('id', $id)
            ->first();

        return view('admin.complaints.edit_complaint')->with($data);
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
        DB::table('user_complaint_register')->where('id', $id)->update([
            'status_id' => $request->comp_status,
        ]);

        $update_comp = DB::table('user_complaint_register')
            ->select('user_complaint_register.id as complaint_id', 'users.*', 'user_complaint_register.*')
            ->join('users', 'users.id', '=', 'user_complaint_register.user_id')
            ->where('users.id', $id)
            ->first();

        $result = $this->notifications($update_comp->device_token, $update_comp->user_id, $update_comp->complaint_id);

        echo json_encode($result);

        Session::flash('success', 'Complaint has been updated.');

        return redirect()->route('complaint.index');
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
        $data['heading'] = 'Pending Complaints';
        $data['pending_complaints'] = DB::table('user_complaint_register')
            ->join('users', 'users.id', '=', 'user_complaint_register.user_id')
            ->join('complaint_status', 'complaint_status.id', '=', 'user_complaint_register.status_id')
            ->where('status_id', 1)
            ->get();
        // dd($data['complaints']);
        return view('admin.complaints.pending')->with($data);
    }
    public function inprogress()
    {
        $data['heading'] = 'Inprogress Complaints';
        $data['inprogress_complaints'] = DB::table('user_complaint_register')
            ->join('users', 'users.id', '=', 'user_complaint_register.user_id')
            ->join('complaint_status', 'complaint_status.id', '=', 'user_complaint_register.status_id')
            ->where('status_id', 3)
            ->get();

        return view('admin.complaints.inprogress')->with($data);
    }
    public function irrelevant()
    {
        $data['heading'] = 'Irrelevant Complaints';
        $data['irrelevant_complaints'] = DB::table('user_complaint_register')
            ->join('users', 'users.id', '=', 'user_complaint_register.user_id')
            ->join('complaint_status', 'complaint_status.id', '=', 'user_complaint_register.status_id')
            ->where('status_id', 4)
            ->get();

        return view('admin.complaints.irrelevant')->with($data);
    }
    public function not_understandable()
    {
        $data['heading'] = 'Not Understandable Complaints';
        $data['not_understandable_complaints'] = DB::table('user_complaint_register')
            ->join('users', 'users.id', '=', 'user_complaint_register.user_id')
            ->join('complaint_status', 'complaint_status.id', '=', 'user_complaint_register.status_id')
            ->where('status_id', 5)
            ->get();

        return view('admin.complaints.not_understandable')->with($data);
    }
    public function completed()
    {
        $data['heading'] = 'Completed Complaints';
        $data['completed_complaints'] = DB::table('user_complaint_register')
            ->join('users', 'users.id', '=', 'user_complaint_register.user_id')
            ->join('complaint_status', 'complaint_status.id', '=', 'user_complaint_register.status_id')
            ->where('status_id', 2)
            ->get();

        return view('admin.complaints.completed')->with($data);
    }

    public function notifications($device_token, $user_id, $complaint_id)
    {
		#API access key from Google API’s Console
        define('API_ACCESS_KEY', 'AAAAr226zMg:APA91bHsEv3XCCM7aM5CCVAWt5Gi2ntBmYa5CI2HXmGK6qNLa4gEpTErrIK8BjEPGv8g549kp5Uni-urom5KIrukozzRFFPcPfAAUWIxXdTHAJ44kNmktDE-4Sx1E0d26bJGf1SgM5FR');


        $arr = array(
            'complaint_id' => $user_id,
            'user_id' => $complaint_id,
        );

        $fields = array(
            'body' => 'Someone needs your help!.',
            'title' => 'Attention!',
            'icon' => 'myicon',/*Default Icon*/
            'sound' => 'mySound',/*Default sound*/
            'vibrate' => 1,
            'click_action' => 'ACTIVITY_DONOR',
            'complain_data' => $arr,
        );


        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

		#Send Reponse To FireBase Server    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
		#Echo Result Of FireBase Server
		//echo $result;



        return [

            'success' => 'true',
            'status' => 200,
            'to' => $device_token,
            'data' => $fields
        ];
    }
}
