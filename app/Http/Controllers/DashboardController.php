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
use App\Classes\FinancePeriodClass;

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

    public static function getBegin($witch) {
        if ($witch == 'year') {
            $begin = date('Y-m-d', strtotime('first day of January'));
        } elseif ($witch == 'mount') {
            $begin = date('Y-m-d', strtotime('first day of this month'));
        } elseif ($witch == 'week') {
            $begin = date('Y-m-d', strtotime('Monday this week'));
        }
        return $begin;
    }

    public static function getEnd($witch) {
        if ($witch == 'year') {
            $end   = date('Y-m-d', strtotime('last day of December'));
        } elseif ($witch == 'mount') {
            $end   = date('Y-m-d', strtotime('last day of this month'));
        } elseif ($witch == 'week') {
            $end   = date('Y-m-d', strtotime('Sunday this week'));
        }
        return $end;
    }

    public static function sumInvoice(Request $request) {
        $financeClass = new FinancePeriodClass(self::getBegin($request->get('witch')), self::getEnd($request->get('witch')));
        return $financeClass->invoicesAmountPeriod();
    }

    public static function sumClosure(Request $request) {
        $financeClass = new FinancePeriodClass(self::getBegin($request->get('witch')), self::getEnd($request->get('witch')));
        return $financeClass->closuresAmountPeriod();
    }

    public static function sumFinancialResult(Request $request) {
        $financeClass = new FinancePeriodClass(self::getBegin($request->get('witch')), self::getEnd($request->get('witch')));
        return $financeClass->closuresAmountPeriod() - $financeClass->invoicesAmountPeriod();
    }

    public static function sumCash(Request $request) {
        $closuresClass = new ClosuresClass(self::getBegin($request->get('witch')), self::getEnd($request->get('witch')));
        return $closuresClass->cashPeriod();
    }

    public static function sumCard(Request $request) {
        $closuresClass = new ClosuresClass(self::getBegin($request->get('witch')), self::getEnd($request->get('witch')));
        return $closuresClass->cardPeriod();
    }

    public static function sumSZCard(Request $request) {
        $closuresClass = new ClosuresClass(self::getBegin($request->get('witch')), self::getEnd($request->get('witch')));
        return $closuresClass->szcardPeriod();
    }

    public static function sumAverige(Request $request) {
        $closuresClass = new ClosuresClass(self::getBegin($request->get('witch')), self::getEnd($request->get('witch')));
        return $closuresClass->averigePeriod();
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
