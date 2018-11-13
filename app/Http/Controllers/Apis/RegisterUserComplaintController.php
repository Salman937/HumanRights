<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use DB;
use App\User;
use Auth;
use PushNotification;
use Illuminate\Support\Facades\Storage;

class RegisterUserComplaintController extends Controller
{
	public function index(Request $request)
	{
		$user = User::find(Auth::guard('api')->id());

		if (!$user) {
			return response()->json([

				'status' => false,
				'code' => 401,
				'api_token' => "User is not Registered"
			]);
		}

		$validate = Validator::make($request->all(), [

			'complaint_type' => 'required',
			'sub_complaint_type' => 'required',
			'subject' => 'required',
			'details' => 'required',
			'user_id' => 'required',
			'dept_name' => 'required',
			'person_phone_number' => 'required',
			'location' => 'required',
			'person_email' => 'required|email',
			'person_address' => 'required',
		]);

		if ($validate->fails()) {
			return response()->json([

				'success' => 'false',
				'status' => '401',
				'message' => 'Please Review All Fields',
				'errors' => $validate->errors()
			]);
		}

		if ($request->hasFile('image')) {
			$images = $request->image;

			$imagesPath = [];

			foreach ($images as $image) {
				$filename = time() . $image->getClientOriginalName();

				Storage::put($filename, file_get_contents($image->getRealPath()));
				
				//  = $image->store("complaints_data", 'public_storage');
				$imagesPath[] = $filename;
			}
		}

		if ($request->hasFile('audio')) {
			$audio = $request->audio;

			$new_audio = time() . $audio->getClientOriginalName();

			$audio->move('uploads/complaints_data', $new_audio);

			$upload_audio = 'uploads/complaints_data/' . $new_audio;
		}

		if ($request->hasFile('video')) {
			$video = $request->video;

			$path = $video->store("complaints_data", 'public_storage');
            // $new_video = time().$video->getClientOriginalName();

            // $video->move('uploads/complaints_data',$new_video);

			$upload_video = 'uploads/' . $path;
		}

		if ($request->hasFile('document')) {
			$doc_file = $request->document;

			$path = $doc_file->store("complaints_data", 'public_storage');

			$document_file = 'public/uploads/' . $path;
		}


		$user = DB::table('user_complaint_register')->insert([

			'complaint_type' => $request->complaint_type,
			'sub_complaint_type' => $request->sub_complaint_type,
			'subject' => $request->subject,
			'details' => $request->details,
			'user_id' => $request->user_id,
			'dept_name' => $request->dept_name,
			'person_phone_number' => $request->person_phone_number,
			'location' => $request->location,
			'person_email' => $request->person_email,
			'person_address' => $request->person_address,
			'image' => empty($imagesPath) ? 'Null' : implode(',', $imagesPath),
			'audio' => empty($upload_audio) ? 'Null' : $upload_audio,
			'video' => empty($upload_video) ? 'Null' : $upload_video,
			'document_file' => empty($document_file) ? 'Null' : $document_file,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		]);

		return response()->json([

			'success' => 'true',
			'status' => 200,
			'message' => 'User Complaint Register',
		]);
	}

	public function testing_notification()
	{
		define('API_ACCESS_KEY', 'AAAAr226zMg:APA91bHsEv3XCCM7aM5CCVAWt5Gi2ntBmYa5CI2HXmGK6qNLa4gEpTErrIK8BjEPGv8g549kp5Uni-urom5KIrukozzRFFPcPfAAUWIxXdTHAJ44kNmktDE-4Sx1E0d26bJGf1SgM5FR');


		$data = DB::table('users')->get();

		$arr = array();

		foreach($data as $user)
		{
			$user_data[] = array(

					'id' => $user->id,
					'name' => $user->name,
					'mobile_no' => $user->mobile_no,
					'cnic' => $user->cnic,
					'city' => $user->city,
			);
		}
		
		$msg = array(
			'complain_data' => $arr,
			'icon' => 'myicon',  /*Default Icon*/
			'sound' => 'mySound',/*Default sound*/
			'vibrate' => 1,
			 
			// activity name which will be called after notify
			'click_action' => 'DetailListActivity'


		);

		$fields = array(

			'to' => 'fvj31mJjX7w:APA91bHO1ZiPL7qIlHMSNhY21m-S4pkhf21UyO8TssgZa1bnikaeW0OErZHvn1aZ7bBtD2JSpt4aCuhQbtCdB-6ul0EIMBwWrCwT7JoEBG2OpdqnxTcASTX2OGYaEJXrnVBxb6BgnftI',

			'msg' => 'This is First Notification from Human Righst',

			'title' => "This Notification Title",

			'data' => $msg,
			'complaint_id' => 2

		);

		$headers = array(

			'Authorization: key=' . API_ACCESS_KEY,

			'Content-Type: application/json'

		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);

		// echo $result;
		return response()->json([

			'success' => 'true',
			'status' => 200,
			'message' => 'Notification Send',
			'notification' => $fields
		]);
		// return $fields;
	}
}
