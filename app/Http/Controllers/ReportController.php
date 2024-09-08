<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{

    function ReportPage(){
        return view('pages.dashboard.report-page');
    }
    
    function SalseReport(Request $request){
        $fromDate = date('Y-m-d', strtotime($request->FromDate));
        $toDate = date('Y-m-d', strtotime($request->ToDate));
        $userId = $request->header('id');

        $total = Invoice::where('user_id', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->sum('total');
        $vat = Invoice::where('user_id', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->sum('vat');   
        $payable = Invoice::where('user_id', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->sum('payable');   
        $discount = Invoice::where('user_id', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->sum('discount');   

        $list = Invoice::where('user_id', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->with('customer')->get();

        $data = [
            'total' => $total,
            'vat' => $vat,
            'payable' => $payable,
            'discount' => $discount,
            'list' => $list,
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ];

        // return $data;

        $pdf = Pdf::loadView('report.SalesReport', $data);
        return $pdf->download('invoice.pdf');
    }
}
