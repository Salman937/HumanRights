<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class CategoriesController extends Controller
{
        public function index()
        {
                $categories = DB::table('categories')->where('level', 0)->get();

                return response()->json([

                        'success' => 'true',
                        'status' => 200,
                        'message' => 'Categories',
                        'All categories' => $categories,
                ]);
        }

        public function sub_categories(Request $request)
        {
                $validator = Validator::make($request->all(), [

                        'category_id' => 'required',

                ]);

                if ($validator->fails()) {
                        return response()->json([

                                'success' => 'false',
                                'status' => '401',
                                'message' => 'Please Review All Fields',
                                'errors' => $validator->errors()
                        ]);
                }

                $sub_cat = DB::table('categories')
                        ->where([
                                ['level', 1],
                                ['parent_id', '=', $request->category_id]
                        ])
                        ->get();

                if ($sub_cat->isEmpty()) {
                        return response()->json([

                                'success' => 'false',
                                'status' => 404,
                                'message' => 'Sub Category not Found',
                        ]);
                } else {
                        return response()->json([

                                'success' => 'true',
                                'status' => 200,
                                'message' => 'Sub Categories',
                                'Sub Categories' => $sub_cat,
                        ]);
                }
        }

        public function thrid_category(Request $request)
        {
                $validator = Validator::make($request->all(), [

                        'sub_category_id' => 'required',

                ]);

                if ($validator->fails()) {
                        return response()->json([

                                'success' => 'false',
                                'status' => '401',
                                'message' => 'Please Review All Fields',
                                'errors' => $validator->errors()
                        ]);
                }

                $sub_cat = DB::table('categories')
                        ->where([
                                ['level', 2],
                                ['parent_id', '=', $request->sub_category_id]
                        ])
                        ->get();

                if ($sub_cat->isEmpty()) {
                        return response()->json([

                                'success' => 'false',
                                'status' => 404,
                                'message' => 'Category not Found',
                        ]);
                } else {
                        return response()->json([

                                'success' => 'true',
                                'status' => 200,
                                'message' => 'Thrid layer of Categories',
                                'Sub Categories' => $sub_cat,
                        ]);
                }
        }

        public function districts()
        {
                $districts = DB::table('districts')->get();

                return response()->json([

                        'success' => 'true',
                        'status' => 200,
                        'message' => 'districts',
                        'All Districts' => $districts,
                ]);   
        }

        public function all_sub_cat(Request $request)
        {
                $sub_cat = DB::table('categories')
                        ->where([
                                ['level','!=', 0]
                        ])
                        ->get();
                if ($sub_cat->isEmpty()) {
                        return response()->json([

                                'success' => 'false',
                                'status' => 404,
                                'message' => 'Not Found',
                        ]);
                } else {
                        return response()->json([

                                'success' => 'true',
                                'status' => 200,
                                'message' => 'All Sub Categories',
                                'Sub Categories' => $sub_cat,
                        ]);
                }
        }
}
