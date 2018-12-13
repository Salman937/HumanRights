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
            ->orderBy('user_complaint_register.id','desc')
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

        // dd($data['complaint']);die;

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
            ->select('user_complaint_register.*', 'users.device_token as device_token')
            ->join('users', 'users.id', '=', 'user_complaint_register.user_id')
            ->where('user_complaint_register.id', $id)
            ->first();

            if($update_comp->status_id == 1):
                $status = 'Pending';
            elseif($update_comp->status_id == 2):
                $status = "Completed";
            elseif($update_comp->status_id == 3):
                $status = "In Progress";
            elseif($update_comp->status_id == 4):
                $status = "Irrelevant";
            else:
                $status = "Not Understandable";
            endif;

        $data_arr['data'] = array(

                            'user_id' => $update_comp->user_id,
                            'complaint_id' => $update_comp->id,
                            'title' => $update_comp->subject,
                            'decs' => $update_comp->details,
                            'status' => $status,
                            'status' => $status,
                            'date' => date('d-m-y',strtotime($update_comp->created_at)),
        );

        $this->notifications($update_comp->device_token,$data_arr);
        // echo json_encode($result);

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
        DB::table('user_complaint_register')->where('id', $id)->delete();

        Session::flash('success','Complaint Deleted Successfully');

        return redirect()->route('complaint.index');
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

    public function notifications($device_token,$data)
    {
		#API access key from Google API's Console
        define('API_ACCESS_KEY', 'AAAAr226zMg:APA91bHsEv3XCCM7aM5CCVAWt5Gi2ntBmYa5CI2HXmGK6qNLa4gEpTErrIK8BjEPGv8g549kp5Uni-urom5KIrukozzRFFPcPfAAUWIxXdTHAJ44kNmktDE-4Sx1E0d26bJGf1SgM5FR');

        $msg = array
         (
             'title'    => $data['data']['title'],
             'body'     => $data['data']['decs'],
             'status'   => $data['data']['status'],
             'date'     => $data['data']['date'],
             'complaint_id'     => $data['data']['complaint_id'],
             'user_id'     => $data['data']['user_id'],
             'vibrate'  => 1,
             'click_action' => 'ACTIVITY_DONOR',
         );
        
        $fields = array(
            'to'        => $device_token,
            'notification'    => $msg,
        );

        // dd($fields);

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
		// echo $result;
    }
}
