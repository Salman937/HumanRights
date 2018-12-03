<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

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
        // dd($request->description);
        $featured = $request->image;
        $featured_image_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/announcement/',$featured_image_name);

        DB::table('announcements')->insert(array(
            array('title' => $request->title,'description' => $request->description,'image' => asset('uploads/announcement/'.$featured_image_name))
        ));

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
                                ->where('id', 1)
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
            'category' => 'required'
        ]);

        $category = Category::find($id);

        $category->category = $request->category;
        $category->category_slug = str_slug($request->category, '-');
        $category->level = 0;
        $category->parent_id = 0;
        
        $category->save();

        Session::flash('success','Your Data Is Updated.');
        
        return redirect()->route('category.index');
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
