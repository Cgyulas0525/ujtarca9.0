<?php

namespace App\Http\Controllers;

use App\Models\Monthstacked;
use App\Models\Weekstacked;
use App\Models\Yearstacked;
use App\Repositories\MonthstackedRepository;
use App\Repositories\WeekstackedRepository;
use App\Repositories\YearstackedRepository;
use Auth;
use Illuminate\Http\Request;
use DataTables;

class StackedReportsController
{

    protected $yearstackedRepository, $monthstackedRepository, $weekstackedRepository;

    public function __construct(YearstackedRepository $yearstackedRepository,
                                MonthstackedRepository $monthstackedRepository,
                                WeekstackedRepository $weekstackedRepository)
    {
        $this->yearstackedRepository = $yearstackedRepository;
        $this->monthstackedRepository = $monthstackedRepository;
        $this->weekstackedRepository = $weekstackedRepository;
    }

    public function getMonthStacked(?int $months = null)
    {
        return Monthstacked::orderBy('id', 'desc')->take($months)->get();
    }

    public function getWeekStacked(?int $weeks = null)
    {
        return Weekstacked::orderBy('id', 'desc')->take($weeks)->get();
    }

    public function dwDataWeek($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('yearweek', function ($data) {
                return ($data->yearweek);
            })
            ->addColumn('result', function ($data) {
                return ($data->result);
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dwDataMonth($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('yearmonth', function ($data) {
                return ($data->yearmonth);
            })
            ->addColumn('result', function ($data) {
                return ($data->result);
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dwDataYear($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('result', function ($data) {
                return ($data->result);
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getMonthStackedIndex(Request $request)
    {
        if (!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $data = $this->getMonthStacked(13);

        if ($request->ajax()) {
            return $this->dwDataMonth($this->getMonthStacked());
        }

        return view('stacked_report.month_stacked_index', ['data' => $data] );
    }

    public function getYearStackedIndex(Request $request)
    {
        if (!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $data = Yearstacked::all();

        if ($request->ajax()) {
            return $this->dwDataYear($data);
        }

        return view('stacked_report.year_stacked_index', ['data' => $data] );
    }

    public function getWeekStackedIndex(Request $request)
    {
        if (!Auth::check()) {
            abort(401, 'Unauthorized');
        }

        $data = $this->getWeekStacked(27);

        if ($request->ajax()) {
            return $this->dwDataWeek($this->getWeekStacked());
        }

        return view('stacked_report.week_stacked_index', ['data' => $data] );
    }

}
