<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Session;
use DB;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heading']    = 'First Category List';
        $data['categories'] = Category::where('level',0)
                                        ->get();

        return view('admin.headcategory.list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading']    = 'Add Category';
        return view('admin.headcategory.create')->with($data);
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
            'category' => 'required'
        ]);

        $category = new Category;

        $category->cat_name = $request->category;
        $category->cat_slug = str_slug($request->category, '-');
        $category->level = 0;
        $category->parent_id = 0;
        
        $category->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('category.index');
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
        $data['heading'] = 'Edit Category';
        $data['category'] = Category::find($id);

        return view('admin.headcategory.edit')->with($data);
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

        $category->cat_name = $request->category;
        $category->cat_slug = str_slug($request->category, '-');
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
        $cat = DB::table('categories')->where('id', $id)->first();

        $secound_cat = DB::table('categories')->where('parent_id', $id)->get();
        foreach ($secound_cat as $sec_key => $sec_value) {
            $third_cat = DB::table('categories')->where('parent_id', $sec_value->id)->get();
            foreach ($third_cat as $third_key => $third_value) {
                DB::table('categories')->where('id', $third_value->id)->delete();
            }
            DB::table('categories')->where('id', $sec_value->id)->delete();
        }
        DB::table('categories')->where('id', $id)->delete();

        Session::flash('success','Record is deleted seccussfully');
        return redirect()->back();
    }

    public function third_category_list()
    {
        $data['heading']    = 'Third Category List';
        $data['categories'] = Category::where('level',0)->get();
        $data['third_category'] =  DB::table('categories AS a')
                                    ->select('a.cat_name AS parent_cat', 'b.cat_name AS sec_cat', 'c.*')
                                    ->where('b.level', '=', 1)
                                    ->join('categories AS b',function ($join) {
                                        $join->on('b.parent_id', '=', 'a.id');
                                    })
                                    ->join('categories AS c',function ($join) {
                                        $join->on('c.parent_id', '=', 'b.id');
                                    })
                                    ->get();
        return view('admin.thirdcategory.list')->with($data);
    }
    public function get_cat(Request $request)
    {
        $data = Category::where('parent_id',$request->id)->get();
        print json_encode($data);
    }
    public function thirdcategory_store(Request $request)
    {
        $this->validate($request,[
            'head_category' => 'required',
            'secound_cat' => 'required',
            'category' => 'required'
        ]);

        $category = new Category;

        $category->cat_name = $request->category;
        $category->cat_slug = str_slug($request->category, '-');
        $category->level = 2;
        $category->parent_id = $request->secound_cat;
        
        $category->save();

        Session::flash('success','Your data is save.');
        
        return redirect()->route('third.category');
    }
    public function thirdcategory_edit($id)
    {
        $data['heading'] = 'Edit Category';
        $data['third_category'] = Category::find($id);

        $data['fi_category']=Category::where('level',0)->get();
        $data['sc_category']=Category::where('level',1)->get();
        $data['secound_category']=Category::where('id',$data['third_category']->parent_id)->first();
        $data['first_category']=Category::where('id',$data['secound_category']->parent_id)->first();

        return view('admin.thirdcategory.edit')->with($data);
    }

    public function thirdcategory_update(Request $request, $id)
    {
        $this->validate($request,[
            'head_category' => 'required',
            'sec_category' => 'required',
            'category' => 'required'
        ]);

        $category = Category::find($id);

        $category->cat_name = $request->category;
        $category->cat_slug = str_slug($request->category, '-');
        $category->level = 2;
        $category->parent_id = $request->sec_category;
        
        $category->save();

        Session::flash('success','Record Is Updated Seccussfully');
        
        return redirect()->route('third.category');
    }
    public function thirdcategory_destory($id)
    {
        $cat = Category::find($id);

        $cat->delete();
        Session::flash('success','Record Is Deleted Seccussfully');
        return redirect()->back();
    }
}
