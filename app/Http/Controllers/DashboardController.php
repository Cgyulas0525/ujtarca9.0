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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.dashboard');
    }
}
