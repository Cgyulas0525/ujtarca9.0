<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInvoicesRequest;
use App\Http\Requests\UpdateInvoicesRequest;
use App\Repositories\InvoicesRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Invoices;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use Form;

class InvoicesController extends AppBaseController
{
    /** @var InvoicesRepository $invoicesRepository */
    private $invoicesRepository;

    public function __construct(InvoicesRepository $invoicesRepo)
    {
        $this->invoicesRepository = $invoicesRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('paymentMethodName', function ($data) {
                return ($data->paymentMethodName);
            })
            ->addColumn('partnerName', function ($data) {
                return ($data->partner->name);
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('invoices.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Invoices', $row->id, 'invoices']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Invoices.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {

                $data = $this->invoicesRepository->all();
                return $this->dwData($data);

            }

            return view('invoices.index');
        }
    }

    /**
     * Show the form for creating a new Invoices.
     *
     * @return Response
     */
    public function create()
    {
        return view('invoices.create');
    }

    public function invoicesIndex(Request $request, $year = null, $partner = null)
    {
        if (Auth::check()) {
            if ($request->ajax()) {

                return $this->dwData(Invoices::with('paymentmethod')
                    ->with('partner')
                    ->where(function ($query) use ($partner) {
                        is_null($partner) ? $query->whereNotNull('partner_id') : $query->where('partner_id', '=', $partner);
                    })
                    ->where(function ($query) use ($year) {
                        is_null($year) ? $query->whereNotNull('dated') : $query->whereYear('dated', '=', $year);
                    })->get());
            }

            return view('invoices.index');
        }
    }

    /**
     * Store a newly created Invoices in storage.
     *
     * @param CreateInvoicesRequest $request
     *
     * @return Response
     */
    public function store(CreateInvoicesRequest $request)
    {
        $input = $request->all();

        $invoices = $this->invoicesRepository->create($input);

//        return redirect(route('invoices.index'));
        return view('invoices.create');
    }

    /**
     * Display the specified Invoices.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoices = $this->invoicesRepository->find($id);

        if (empty($invoices)) {
            return redirect(route('invoices.index'));
        }

        return view('invoices.show')->with('invoices', $invoices);
    }

    /**
     * Show the form for editing the specified Invoices.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoices = $this->invoicesRepository->find($id);

        if (empty($invoices)) {
            return redirect(route('invoices.index'));
        }

        return view('invoices.edit')->with('invoices', $invoices);
    }

    /**
     * Update the specified Invoices in storage.
     *
     * @param int $id
     * @param UpdateInvoicesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvoicesRequest $request)
    {
        $invoices = $this->invoicesRepository->find($id);

        if (empty($invoices)) {
            return redirect(route('invoices.index'));
        }

        $invoices = $this->invoicesRepository->update($request->all(), $id);

        return redirect(route('invoices.index'));
    }

    /**
     * Remove the specified Invoices from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $invoices = $this->invoicesRepository->find($id);

        if (empty($invoices)) {
            return redirect(route('invoices.index'));
        }

        $this->invoicesRepository->delete($id);

        return redirect(route('invoices.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW(): array
    {
        return [" "] + Invoices::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function invoicesYearsDDDW()
    {
        return [" "] + Invoices::selectRaw('year(invoices.dated) as year')->groupBy('year')
                ->orderBy('year', 'desc')
                ->pluck('year', 'year')->toArray();
    }

    public static function fields($invoice)
    {
        $formGroupArray = [];
        $item = ["label" => Form::label('partner_id', 'Partner:'),
            "field" => Form::select('partner_id', PartnersController::DDDWSupplier(), null,
                ['class' => 'select2 form-control', 'id' => 'partner_id', 'required' => true]),
            "width" => 12,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('invoicenumber', 'Számlaszám:'),
            "field" => Form::text('invoicenumber', null, ['class' => 'form-control', 'maxlength' => 25, 'required' => true]),
            "width" => 4,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('paymentmethod_id', 'Fizetési mód:'),
            "field" => Form::select('paymentmethod_id', PaymentMethodsController::DDDW(), null,
                ['class' => 'select2 form-control', 'id' => 'paymentmethod_id', 'required' => true]),
            "width" => 4,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('amount', 'Összeg:'),
            "field" => Form::number('amount', isset($invoice) ? $invoice->amount : 0, ['class' => 'form-control  text-right', 'id' => 'amount', 'required' => true]),
            "width" => 4,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('dated', 'Kelt:'),
            "field" => Form::date('dated', isset($invoice) ? $invoice->dated : \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'dated', 'required' => true]),
            "width" => 4,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('performancedate', 'Teljesítés:'),
            "field" => Form::date('performancedate', isset($invoice) ? $invoice->performancedate : \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'performancedate', 'required' => true]),
            "width" => 4,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('deadline', 'Határidő:'),
            "field" => Form::date('deadline', isset($invoice) ? $invoice->deadline : \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'deadline', 'required' => true]),
            "width" => 4,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('description', 'Megjegyzés:'),
            "field" => Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 500, 'rows' => 4, 'id' => 'description']),
            "width" => 12,
            "file" => false];
        array_push($formGroupArray, $item);
        return $formGroupArray;
    }
}



