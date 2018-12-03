<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Category;
use DB;

class SubcategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading'] = 'Secound Category list';
        $data['categories'] = Category::where('level',0)->get();
        $data['subcategories'] =  DB::table('categories AS a')
                                    ->select('a.cat_name AS parent_cat', 'b.*')
                                    ->join('categories AS b',function ($join) {
                                        $join->on('b.parent_id', '=', 'a.id')
                                        ->where('b.level', '=', 1);
                                    })
                                    ->get();
        return view('admin.subcategory.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading'] = 'Add Secound Category';
        $data['categories'] = Category::where('level',0)->get();

        return view('admin.subcategory.create')->with($data);
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
            'head_category' => 'required',
            'category' => 'required',
        ]);

        $category = new Category;

        $category->cat_name = $request->category;
        $category->cat_slug = str_slug($request->category, '-');
        $category->level = 1;
        $category->parent_id = $request->head_category;
        
        $category->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('subcategory.index');
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
        $data['heading'] = 'Edit Sub Category';
        $data['category'] = Category::find($id);
        $data['head_category'] = Category::where('level',0)->get();
        return view('admin.subcategory.edit')->with($data);
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
            'head_category' => 'required',
            'category' => 'required'
        ]);

        $category = Category::find($id);
        $category->cat_name = $request->category;
        $category->cat_slug = str_slug($request->category, '-');
        $category->level = 1;
        $category->parent_id = $request->head_category;
        
        $category->save();

        Session::flash('success','Your Data Is Updated.');
        
        return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $secound_cat = DB::table('categories')->where('id', $id)->first();
        $third_cat = DB::table('categories')->where('parent_id', $id)->get();
        foreach ($third_cat as $thir_key => $thir_value) {
            DB::table('categories')->where('id', $thir_value->id)->delete();
        }
        DB::table('categories')->where('id', $id)->delete();

        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }
}
