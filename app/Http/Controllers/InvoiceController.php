<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;


class InvoiceController extends Controller
{

    function SalePage(){
        return view('pages.dashboard.sale-page');
    }

    function InvoicePage(){
        return view('pages.dashboard.invoice-page');
    }

    function InvocieCreate(Request $request){
        DB::beginTransaction();

        try{
            $user_id = $request->header('id');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $payable = $request->input('payable');

            $customer_id = $request->input('customer_id');

            $invoice = Invoice::create([
                'total' => $total,
                'discount' => $discount,
                'vat' => $vat,
                'payable' => $payable,
                'user_id' => $user_id,
                'customer_id' => $customer_id
            ]);

            $invoice_id = $invoice->id;

            $products = $request->input('products');

            foreach($products as $eachProduct){
                InvoiceProduct::create([
                    'invoice_id' => $invoice_id,
                    'user_id' => $user_id,
                    'product_id' => $eachProduct['product_id'],
                    'qty' => $eachProduct['qty'],
                    'sale_price' => $eachProduct['sale_price']
                ]);
            }

            DB::commit();

            return 1;

        } catch(Exception $e){
            DB::rollBack();
            return 0;
        }
    }

    function InvoiceSelect(Request $request){
        $userId = $request->header('id');
        return Invoice::where('user_id', $userId)->with('customer')->get();
    }

    function InvoiceDetails(Request $request){
        $userId = $request->header('id');
        
        $customerDetails = Customer::where('user_id', $userId)->where('id', $request->input('cus_id'))->first();

        $invoiceTotal = Invoice::where('user_id', $userId)->where('id', $request->input('inv_id'))->first();

        $invoiceProduct = InvoiceProduct::where('invoice_id', $request->input('inv_id'))->where('user_id', $userId)->with('product')->get();

        return array(
            'customer' => $customerDetails,
            'invoice' => $invoiceTotal,
            'product' => $invoiceProduct
        );
    }

    function InvoiceDelete(Request $request){
        DB::beginTransaction();

        try{
            $user_id = $request->header('id');
            InvoiceProduct::where('invoice_id', $request->input('inv_id'))->where('user_id', $user_id)->delete();
            Invoice::where('id', $request->input('inv_id'))->delete();
            DB::commit();
            return 1;
        } catch(Exception $e){
            DB::rollBack();
            return 0;
        }
    }

}
