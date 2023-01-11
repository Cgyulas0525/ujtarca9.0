<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use DataTables;
use Auth;
use FinanceClass;
use ClosuresClass;

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
        $financeClass = new FinanceClass($year);
        return $financeClass->invoicesAmountSumYear();
    }

    public static function closuresAmountSumThisYear($year) {
        $financeClass = new FinanceClass($year);
        return $financeClass->closuresAmountSumYear()[0]->dailysum;
    }

    public static function financialResultThisYear($year) {
        $financeClass = new FinanceClass($year);
        return $financeClass->closuresAmountSumYear()[0]->dailysum - $financeClass->invoicesAmountSumYear();
    }

    public static function cashThisYear($begin, $end) {
        $closuresClass = new ClosuresClass($begin, $end);
        return $closuresClass->cashPeriod();
    }

    public static function cardThisYear($begin, $end) {
        $closuresClass = new ClosuresClass($begin, $end);
        return $closuresClass->cardPeriod();
    }

    public static function szcardThisYear($begin, $end) {
        $closuresClass = new ClosuresClass($begin, $end);
        return $closuresClass->szcardPeriod();
    }

    public static function averigeThisYear($begin, $end) {
        $closuresClass = new ClosuresClass($begin, $end);
        return $closuresClass->averigePeriod();
    }

    public static function closuresAmountSumAll() {
        $data = DB::table('closures as t1')
            ->select(DB::raw('sum(t1.dailysum - 20000) as dailysum'))
            ->whereNull('t1.deleted_at')
            ->get();

        return $data[0]->dailysum;
    }

    public static function invoicesAmountSumall() {
        return DB::table('invoices')
            ->whereNull('deleted_at')
            ->get()
            ->sum('amount');

    }

    public static function cashAll() {
        $data = DB::table('closures')
            ->select(DB::raw('sum(dailysum - (card + szcard + 20000)) as cash'))
            ->whereNull('deleted_at')
            ->get();

        return $data[0]->cash;
    }

    public static function cardall() {
        return DB::table('closures')
            ->whereNull('deleted_at')
            ->get()->sum('card');
    }

    public static function szcardAll() {
        return DB::table('closures')
            ->whereNull('deleted_at')
            ->get()->sum('szcard');
    }

    public static function averigeAll() {
        $data = DB::table('closures')
            ->select(DB::raw('sum(1) as day, sum(dailysum - 20000) as sum'))
            ->whereNull('deleted_at')
            ->get();

        return Round($data[0]->sum / $data[0]->day, 0);

    }



}
