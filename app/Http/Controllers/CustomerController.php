<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{

    function CustomerPage(){
        return view('pages.dashboard.customer-page');
    }

    function CustomerCreate(Request $request){
        try{
            $userId = $request->header('id');

            Customer::create([
                'user_id' => $userId,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'customer create success',
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage(),
            ]);
        }
    }

    function CustomerUpdate(Request $request){
        try{
            $userId = $request->header('id');
            $customerId = $request->input('id');

            Customer::where('id',$customerId)->where('user_id', $userId)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Customer update success'
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage()
            ]);
        }
    }

    function CustomerDelete(Request $request){
        try{
            $userId = $request->header('id');
            $customerId = $request->input('id');

            $result = Customer::where('id',$customerId)->where('user_id', $userId)->delete();

            if($result){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Customer delete success'
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

    function CustomerById(Request $request){
        try{
            $userId = $request->header('id');
            $customerId = $request->input('id');

            return Customer::where('id', $customerId)->where('user_id', $userId)->first();

        } catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'.$e->getMessage()
            ]);
        }
    }

    function CustomerList(Request $request){
        $userId = $request->header('id');
        return Customer::where('user_id', $userId)->get();
    }

}
