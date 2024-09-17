<?php

namespace App\Traits\Reports;

use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\Models\Weekstacked;

trait RevenueExpenditureIndexTrait
{
    public function RevenueExpenditureIndex(Request $request) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Weekstacked::all();

                return Datatables::of($data)
                    ->addColumn('yearweek', function($data) { return ($data->yearweek); })
                    ->addColumn('result', function($data) { return ($data->result); })
                    ->addIndexColumn()
                    ->make(true);

            }

            return view('riports.RevenueExpenditureIndex');
        }
    }

}
