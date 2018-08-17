<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use DB;
use App\User;
use Auth;

class RegisterUserComplaintController extends Controller
{
    public function index(Request $request)
    {
    	$user = User::find(Auth::guard('api')->id());

    	if (! $user) 
    	{
    		return response()->json([

    			'status'    => false,
    			'code'      => 401,
    			'api_token' => "User is not Registered"
    		]);
    	} 

    	$validate = Validator::make($request->all(),[

    		'complaint_type' 	  	=> 'required',
    		'sub_complaint_type'  	=> 'required',
    		'subject'		      	=> 'required',
    		'details'  			  	=> 'required',
    		'user_id'  			    => 'required',
    		'dept_name'  			=> 'required',
    		'person_phone_number'  	=> 'required',
    		'location'  			=> 'required',
    		'person_email'  		=> 'required|email',
    		'person_address'  		=> 'required',
    	]);

    	if ($validate->fails()) 
    	{
    		return response()->json([

    			'success' => 'false',
    			'status'  => '401',
    			'message' => 'Please Review All Fields',
    			'errors'  => $validate->errors()
    		]);
    	}

    	if ($request->hasFile('image')) 
        {
            $image = $request->image;

            $path = $image->store("complaints_data", 'public_storage');

            $img = 'uploads/'.$path;
        }

        if ($request->hasFile('audio')) 
        {
            $audio = $request->audio;

            $new_audio= time().$audio->getClientOriginalName();

            $audio->move('uploads/complaints_data',$new_audio);

            $upload_audio = 'uploads/complaints_data/'.$new_audio;
        }

        if ($request->hasFile('video')) 
        {
            $video = $request->video;

            $path = $video->store("complaints_data", 'public_storage');
            // $new_video = time().$video->getClientOriginalName();

            // $video->move('uploads/complaints_data',$new_video);

            $upload_video = 'uploads/'.$path;
        }

        if ($request->hasFile('document')) 
        {
            $doc_file = $request->document;

            $path = $doc_file->store("complaints_data", 'public_storage');

            $document_file = 'uploads/'.$path;
        }


        $user = DB::table('user_complaint_register')->insert([

        	'complaint_type' 	  	=> $request->complaint_type,
    		'sub_complaint_type'  	=> $request->sub_complaint_type,
    		'subject'		      	=> $request->subject,
    		'details'  			  	=> $request->details,
    		'user_id'  			    => $request->user_id,
    		'dept_name'  			=> $request->dept_name,
    		'person_phone_number'  	=> $request->person_phone_number,
    		'location'  			=> $request->location,
    		'person_email'  		=> $request->person_email,
    		'person_address'  		=> $request->person_address,
    		'image'  				=> empty($img) ? 'Null': $img,
    		'audio'  				=> empty($upload_audio) ? 'Null': $upload_audio,
            'video'                 => empty($upload_video) ? 'Null': $upload_video,
    		'document_file'  		=> empty($document_file) ? 'Null': $document_file,
    		'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s'),
        ]);

        return response()->json([

                'success' => 'true',
                'status'  => 200,
                'message' => 'User Complaint Register',
        	]);
    }
}
