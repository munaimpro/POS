<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function CategoryPage(){
        return view('pages.dashboard.category-page');
    }

    function CategoryList(Request $request){
        $userId = $request->header('id');
        return Category::where('user_id', $userId)->get();
    }

    function CategoryCreate(Request $request):JsonResponse{
        try{
            $userId = $request->header('id');
            $categoryName = $request->input('name');
            
            Category::create([
                'name' => $categoryName,
                'user_id' => $userId
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category created'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'
            ]);
        }
    }

    function CategoryUpdate(Request $request):JsonResponse{
        try{
            $userId = $request->header('id');
            $categoryId = $request->input('id');

            Category::where('id', $categoryId)->where('user_id', $userId)->update(['name' => $request->input('name')]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category update success'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage()
            ]);
        }
    }

    function CategoryById(Request $request){
        try{
            $userId = $request->header('id');
            $categoryId = $request->input('id');

            return Category::where('id', $categoryId)->where('user_id', $userId)->first();

        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage()
            ]);
        }
    }

    function CategoryDelete(Request $request){
        try{
            $userId = $request->header('id');
            $categoryId = $request->input('id');

            Category::where('id',$categoryId)->where('user_id', $userId)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'category delete success'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'
            ]);
        }
    }
    
}
