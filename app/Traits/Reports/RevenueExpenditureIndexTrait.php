<?php

namespace App\Traits\Reports;

use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\Models\Weekstacked;

trait RevenueExpenditureIndexTrait
{
    public function RevenueExpenditureIndex(Request $request)
    {
        if (!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $data = Weekstacked::all();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('yearweek', function($data) { return ($data->yearweek); })
                ->addColumn('result', function($data) { return ($data->result); })
                ->addColumn('resultPercent', function($data) { return ($data->resultPercent); })
                ->addIndexColumn()
                ->make(true);
        }

        return view('riports.RevenueExpenditureIndex', ['data' => $data]);
    }

}
