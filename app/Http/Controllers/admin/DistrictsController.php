<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\District;
use DB;
use Session;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading']    = 'District List';
        $data['district'] = District::all();

        return view('admin.district.list')->with($data);
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
            'name' => 'required'
        ]);

        $district = new District;

        $district->name = $request->name;
        $district->slug = $request->name;
        
        $district->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('district.index');
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
        $data['heading'] = 'Edit Awareness';
        $data['awareness'] = Awareness::find($id);
        return view('admin.awareness.edit')->with($data);
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

        $awareness = Awareness::find($id);

        if (!empty($request->image)) {
            $featured = $request->image;
            $featured_image_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/awareness/',$featured_image_name);
            $awareness->image = asset('uploads/awareness/'.$featured_image_name);
        }
        else{
            $awareness->image = $request->pre_image;
        }


        $awareness->title = $request->title;
        $awareness->description = $request->description;
        
        $awareness->save();

        Session::flash('success','Your Data Is Updated.');
        
        return redirect()->route('awareness.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('districts')->where('id', $id)->delete();

        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
}
