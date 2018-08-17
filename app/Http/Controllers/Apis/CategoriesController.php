<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CategoriesController extends Controller
{
    public function index()
    {
    	$categories = DB::table('categories')->where('level', 0)->get();

    	return response()->json([

                'success' => 'true',
                'status'  => 200,
                'message' => 'Categories',
                'All categories' => $categories,
        	]);
    }

    public function sub_categories(Request $request)
    {
    	$sub_cat = DB::table('categories')->where('parent_id', $request->category_id)->get();

    	if ($sub_cat->isEmpty()) 
    	{
    		return response()->json([

                'success' => 'true',
                'status'  => 200,
                'message' => 'Sub Category not Found',
        	]);
    	} 
    	else 
    	{
    		return response()->json([

                'success' => 'true',
                'status'  => 200,
                'message' => 'Sub Categories',
                'Sub Categories' => $sub_cat,
        	]);
    	}
    }
}
