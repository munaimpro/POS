<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    function ProductPage(){
        return view('pages.dashboard.product-page');
    }

    function ProductCreate(Request $request){
        try{
            $userId = $request->header('id');
            $img = $request->file('img');

            $t = time();
            $fileName = $img->getClientOriginalName();
            $imgName = "{$userId}-{$t}-{$fileName}";
            $imgUrl = "uploads/{$imgName}";

            $img->move(public_path('uploads'), $imgName);

            $result = Product::create([
                'user_id' => $userId,
                'category_id' => $request->input('category_id'),
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'unit' => $request->input('unit'),
                'img_url' => $imgUrl,
            ]);

            if($result){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product create success',
                ]);
            } else{
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage(),
            ]);
        }
    }

    function ProductUpdate(Request $request){
        try{
            $userId = $request->header('id');
            $productId = $request->input('id');

            if($request->hasFile('img')){
                $img = $request->file('img');
                $t = time();
                $fileName = $img->getClientOriginalName();
                $imgName = "{$userId}-{$t}-{$fileName}";
                $imgUrl = "uploads/{$imgName}";
                $img->move(public_path('uploads'), $imgName);

                $filePath = $request->input('file_path');
                File::delete($filePath);

                $result = Product::where('id',$productId)->where('user_id', $userId)->update([
                    'category_id' => $request->input('category_id'),
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'unit' => $request->input('unit'),
                    'img_url' => $imgUrl,
                ]);
    
                if($result){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Product update success'
                    ]);
                } else{
                    return response()->json([
                        'status' => 'fail',
                        'message' => 'Something went wrong'
                    ]);
                }
            } else{
                $result = Product::where('id',$productId)->where('user_id', $userId)->update([
                    'category_id' => $request->input('category_id'),
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'unit' => $request->input('unit'),
                ]);
    
                if($result){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Product update success'
                    ]);
                } else{
                    return response()->json([
                        'status' => 'fail',
                        'message' => 'Something went wrong'
                    ]);
                }
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage()
            ]);
        }
    }

    function ProductDelete(Request $request){
        try{
            $userId = $request->header('id');
            $productId = $request->input('id');
            $filePath = $request->input('file_path');

            File::delete($filePath);

            $result = Product::where('id',$productId)->where('user_id', $userId)->delete();

            if($result){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product delete success'
                ]);
            } else{
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Something went wrong'
                ]);
            }
        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage()
            ]);
        }
    }

    function ProductById(Request $request){
        try{
            $userId = $request->header('id');
            $productId = $request->input('id');

            return Product::where('id', $productId)->where('user_id', $userId)->first();

        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage()
            ]);
        }
    }

    function ProductList(Request $request){
        $userId = $request->header('id');
        return Product::where('user_id', $userId)->get();
    }
    
}
