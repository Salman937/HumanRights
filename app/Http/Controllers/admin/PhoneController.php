<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Phone;
use DB;
use Session;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading']    = 'Phone Directory List';
        $data['phone'] = Phone::all();

        return view('admin.phone.list')->with($data);
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
            'name' => 'required',
            'designation' => 'required',
            'office_number' => 'required'
        ]);

        $phone = new Phone;

        $phone->name = $request->name;
        $phone->designation = $request->designation;
        $phone->office_number = $request->office_number;
        
        $phone->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('phone.index');
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
        $data['heading'] = 'Edit Phone Directory';
        $data['phone'] = Phone::find($id);
        return view('admin.phone.edit')->with($data);
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
            'name' => 'required',
            'designation' => 'required',
            'office_number' => 'required'
        ]);

        $phone = Phone::find($id);

        $phone->name = $request->name;
        $phone->designation = $request->designation;
        $phone->office_number = $request->office_number;
        
        $phone->save();

        Session::flash('success','Your Data Is Updated.');
        
        return redirect()->route('phone.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('phone_dir')->where('id', $id)->delete();

        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
}
