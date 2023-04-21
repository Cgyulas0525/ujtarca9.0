<?php

namespace App\Http\Controllers;

use App\Models\Monthstacked;
use App\Models\Weekstacked;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use Form;

class RiportsController extends Controller
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

    public function RevenueExpenditureMonthIndex(Request $request) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Monthstacked::all();

                return Datatables::of($data)
                    ->addColumn('yearmonth', function($data) { return ($data->yearmonth); })
                    ->addColumn('result', function($data) { return ($data->result); })
                    ->addIndexColumn()
                    ->make(true);

            }

            return view('riports.RevenueExpenditureMonthIndex');
        }
    }

    public function averageDailyTurnover(Request $request, $begin, $end) {

        if( Auth::check() ){

            if ($request->ajax()) {
                $data = DB::table('closures as t')
                    ->select(DB::raw('weekday(t.closuredate) nap, (Sum(t.dailysum - 20000) / Sum(1)) osszeg'))
                    ->whereNull('t.deleted_at')
                    ->whereBetween('t.closuredate', [$begin , $end] )
                    ->groupBy('nap')
                    ->orderby('nap')
                    ->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
                return view('riports.RevenueExpenditureMonthIndex');
            }
        }
    }

    public function TurnoverIndex(Request $request) {

        return view('riports.Turnover');

    }

}
