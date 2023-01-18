<?php

namespace App\Http\Controllers;

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
    private $begin;
    private $end;

    public function __construct() {
        $this->begin = date('Y-m-d', strtotime('-53 weeks monday'));
        $this->end   = date('Y-m-d', strtotime('today'));
    }

    public function RevenueExpenditureIndex(Request $request) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $query1 = DB::table('closures')
                    ->select(DB::raw('concat(CONCAT(year(closuredate),"."), if(CAST(week(closuredate) AS UNSIGNED) < 10, concat("0", week(closuredate)), week(closuredate))) as yearweek, sum(dailysum - 20000) as dailysum, 0 as amount'))
                    ->whereNull('deleted_at')
                    ->whereBetween('closuredate', [$this->begin, $this->end])
                    ->groupBy('yearweek')
                    ->orderBy('yearweek');

                $query2 = DB::table('invoices')
                    ->select(DB::raw('concat(CONCAT(year(dated),"."), if(CAST(week(dated) AS UNSIGNED) < 10, concat("0", week(dated)), week(dated))) as yearweek, 0 as dailysum, sum(amount) as amount'))
                    ->whereNull('deleted_at')
                    ->whereBetween('dated', [$this->begin, $this->end])
                    ->groupBy('yearweek')
                    ->orderBy('yearweek')
                    ->union($query1);

                $data = DB::query()->fromSub($query2, 'p_pn')
                    ->select('yearweek', DB::raw('ROUND( SUM(amount), 0) as amount,
                                                               ROUND( SUM(dailysum), 0) as dailysum,
                                                               ROUND( SUM(dailysum), 0) - ROUND( SUM(amount), 0) as result'))
                    ->groupBy('yearweek')
                    ->orderBy('yearweek', 'desc')
                    ->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);

            }

            return view('riports.RevenueExpenditureIndex');
        }
    }

    public function RevenueExpenditureMonthIndex(Request $request) {
        if( Auth::check() ){

            if ($request->ajax()) {

                $query1 = DB::table('closures')
                    ->select(DB::raw('concat(CONCAT(year(closuredate),"."), if(CAST(month(closuredate) AS UNSIGNED) < 10, concat("0", month(closuredate)), month(closuredate))) as yearweek, sum(dailysum - 20000) as dailysum, 0 as amount'))
                    ->whereNull('deleted_at')
                    ->whereBetween('closuredate', [$this->begin, $this->end])
                    ->groupBy('yearweek')
                    ->orderBy('yearweek');

                $query2 = DB::table('invoices')
                    ->select(DB::raw('concat(CONCAT(year(dated),"."), if(CAST(month(dated) AS UNSIGNED) < 10, concat("0", month(dated)), month(dated))) as yearweek, 0 as dailysum, sum(amount) as amount'))
                    ->whereNull('deleted_at')
                    ->whereBetween('dated', [$this->begin, $this->end])
                    ->groupBy('yearweek')
                    ->orderBy('yearweek')
                    ->union($query1);

                $data = DB::query()->fromSub($query2, 'p_pn')
                    ->select('yearweek', DB::raw('ROUND( SUM(amount), 0) as amount,
                                                               ROUND( SUM(dailysum), 0) as dailysum,
                                                               ROUND( SUM(dailysum), 0) - ROUND( SUM(amount), 0) as result'))
                    ->groupBy('yearweek')
                    ->orderBy('yearweek', 'desc')
                    ->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);

            }

            return view('riports.RevenueExpenditureMonthIndex');
        }
    }

    public function averageDailyTurnover(Request $request, $begin, $end) {

        if( Auth::check() ){

            if ($request->ajax()) {
//                $begin = date('Y-m-d', strtotime('first day of this year'));
//                $end   = date('Y-m-d', strtotime('today'));
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
