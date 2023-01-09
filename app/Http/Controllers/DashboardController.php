<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use DataTables;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.dashboard');
    }

    public static function partnerCount() {
        return DB::table('partners')->whereNull('deleted_at')->get()->count();
    }

    public static function invoicesAmountSumThisYear($year) {
        return DB::table('invoices')->whereNull('deleted_at')->where(DB::raw('year(dated)'), $year)->get()->sum('amount');
    }

    public static function closuresAmountSumThisYear($year) {
        $data = DB::table('closures as t1')
            ->select(DB::raw('sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->where(DB::raw('year(t1.closuredate)'), $year )
            ->groupBy(DB::raw('year(t1.closuredate)'))
            ->get();
        return $data[0]->dailysum;
    }
}
