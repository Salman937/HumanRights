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
        DB::table('districts')->insert([
            'name' => $request->name,
            'slug' =>str_slug($request->name)
        ]);

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
        $data['district'] = District::where('district_id',$id)->first();
        return view('admin.district.edit')->with($data);
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
            'name' => 'required'
        ]);

        // $district = District::where('district_id',$id)->first();

        // $district->name = $request->name;
        // $district->slug = str_slug($request->name);
        
        // $district->save();
        DB::table('districts')->where('district_id',$id)
                             ->update([
                                    'name' => $request->name,
                                    'slug' =>str_slug($request->name)
                                ]);

        Session::flash('success','Your Data Is Updated.');
        
        return redirect()->route('district.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('districts')->where('district_id', $id)->delete();

        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
}
