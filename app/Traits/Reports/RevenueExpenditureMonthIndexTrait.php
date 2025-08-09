<?php

namespace App\Traits\Reports;

use Illuminate\Http\Request;
use App\Models\Monthstacked;
use Auth;
use DataTables;

trait RevenueExpenditureMonthIndexTrait
{
    public function RevenueExpenditureMonthIndex(Request $request) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Monthstacked::all();

                return Datatables::of($data)
                    ->addColumn('yearmonth', function($data) { return ($data->yearmonth); })
                    ->addColumn('result', function($data) { return ($data->result); })
                    ->addColumn('resultPercent', function($data) { return ($data->resultPercent); })
                    ->addIndexColumn()
                    ->make(true);

            }

            return view('riports.RevenueExpenditureMonthIndex');
        }
    }

}
