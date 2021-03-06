<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Announcement;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading']    = 'Announcement List';
        $data['announcement'] = DB::table('announcements')
                                        ->get();

        return view('admin.announcement.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $announcement = new Announcement;
        
        $featured = $request->image;
        $featured_image_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/announcement/',$featured_image_name);


        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->image = asset('uploads/announcement/'.$featured_image_name);
        
        $announcement->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('announcement.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['heading'] = 'Edit Announcement';
        $data['announcement'] = DB::table('announcements')
                                ->where('id', $id)
                                ->first();
        return view('admin.announcement.edit')->with($data);
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
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            // 'image' => 'required|image'
        ]);

        $announcement = Announcement::find($id);

        if (!empty($request->image)) {
            $featured = $request->image;
            $featured_image_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/announcement/',$featured_image_name);
            $announcement->image = asset('uploads/announcement/'.$featured_image_name);
        }
        else{
            $announcement->image = $request->pre_image;
        }


        $announcement->title = $request->title;
        $announcement->description = $request->description;
        
        $announcement->save();

        Session::flash('success','Your Data Is Updated.');
        
        return redirect()->route('announcement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('announcements')->where('id', $id)->delete();

        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
}
