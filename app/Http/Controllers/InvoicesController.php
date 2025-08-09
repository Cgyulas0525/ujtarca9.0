<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Models\Partners;
use App\Repositories\InvoicesRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Invoices;
use App\Services\SelectService;
use http\QueryString;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Form;
use App\Services\SWAlertService;
use Illuminate\Support\Facades\Config;
use Mail;
use Illuminate\Support\Facades\Session;
use Event;


class InvoicesController extends AppBaseController
{
    /** @var InvoicesRepository $invoicesRepository */
    private $invoicesRepository;

    public function __construct(InvoicesRepository $invoicesRepo)
    {
        $this->invoicesRepository = $invoicesRepo;
    }

    public function dwData($data): mixed
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
                if ($row->paymentmethod_id == 2) {
                    $btn = $btn . '<a href="' . route('beforeInvoiceReferred', [$row->id, 'invoices']) . '"
                                         class="btn btn-warning btn-sm deleteProduct" title="Utalás"><i class="fab fa-cc-amazon-pay"></i></a>';

                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request): object
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = $this->invoicesRepository->all();
                return $this->dwData($data);
            }
            return view('invoices.index');
        }
        return view('invoices.index');
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function notReferredInvoicesIndex(Request $request, ?int $year = null, ?int $partner = null)
    {
        if (!Auth::check()) {
            return view('invoices.index');
        }

        if (!$year && !$partner) {
            $year = date('Y');
        }

        if (!is_null($year)) {
            Session::put('invoiceYear', $year);
        }

        if (!is_null($partner)) {
            Session::put('invoicePartner', $partner);
        }

        Session::put('invoicesReferred', 'Yes');

        if ($request->ajax()) {
            $invoicesQuery = Invoices::with(['paymentmethod', 'partner'])->notReferred();

            if (!is_null($partner) && $partner != 0) {
                $invoicesQuery->where('partner_id', '=', $partner);
            }

            if (!is_null($year) && $year != 0) {
                $invoicesQuery->whereYear('dated', '=', $year);
            }

            return $this->dwData($invoicesQuery->get());
        }
        return view('invoices.index');
    }

    public function invoicesIndex(Request $request, ?int $year = null, ?int $partner = null): mixed
    {
        if (!Auth::check()) {
            return view('invoices.index');
        }

        if (!$year && !$partner) {
            $year = date('Y');
        }

        if (!is_null($year)) {
            Session::put('invoiceYear', $year);
        }

        if (!is_null($partner)) {
            Session::put('invoicePartner', $partner);
        }

        Session::put('invoicesReferred', 'No');

        if ($request->ajax()) {
            $invoicesQuery = Invoices::with(['paymentmethod', 'partner']);

            if (!is_null($partner) && $partner != 0) {
                $invoicesQuery->where('partner_id', '=', $partner);
            }

            if (!is_null($year) && $year != 0) {
                $invoicesQuery->whereYear('dated', '=', $year);
            }

            return $this->dwData($invoicesQuery->get());
        }
        return view('invoices.index');
    }

    public function referredIndex(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return $this->dwData(Invoices::with('paymentmethod')
                    ->with('partner')
                    ->notReferred()
                    ->orderBy('dated', 'desc')
                    ->get()
                );
            }
            return view('invoices.index');
        }
        return view('invoices.index');
    }

    public function validating($request)
    {
        return $request->validate([
            'partner_id' => 'required|integer',
            'invoicenumber' => 'required|string|max:25',
            'paymentmethod_id' => 'required|integer|min:1',
            'amount' => 'required|integer',
            'dated' => 'required|date',
            'performancedate' => 'required|date',
            'deadline' => 'required|date|after_or_equal:dated',
            'description' => 'nullable|string|max:500',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
            'deleted_at' => 'nullable',
        ],
            [
                'partner_id' => 'A partner kötelező mező!',
                'invoicenumber' => 'A számlaszám kötelező mező!',
                'paymentmethod_id' => 'A fizetési mód kötelező mező!',
                'paymentmethod_id|min' => 'A fizetési mód kötelező mező!',
                'amount' => 'Az összeg kötelező mező!',
                'dated' => 'A kelt kötelező mező!',
                'performancedate' => 'A teljesítés kötelező mező!',
                'deadline' => 'A határidő nem lehet kissebb a keltnél!',
            ]);
    }

    public function store(Request $request): object
    {
        $input = $request->all();
        $result = $this->validating($request);

        if ($result) {
            $invoices = $this->invoicesRepository->create($input);

//            if ($invoices->paymentmethod_id == 2 && is_null($invoices->referred_date)) {
//                $owner = Partners::where('partnertypes_id', 5)->first();
//
//                if ($owner && $owner->email) {
//                    $data = [
//                        "email" => $owner->email,
//                        "title" => 'Utalandó számla!',
//                        "body" => "{$owner->name} új utalandó számlát vett fel a rendszerbe!",
//                        "ugyfel" => 'Cseszneki Gyula',
//                        "datum" => date('Y-m-d'),
//                    ];
//
//                    Mail::raw($data['body'], function ($message) use ($data) {
//                        $message->to($data["email"])
//                            ->subject($data["title"]);
//                    });
//                }
//            }

            return view('invoices.create');
        }

        return view('invoices.index');
    }

    public function show($id): object
    {
        $invoices = $this->invoicesRepository->find($id);
        if (empty($invoices)) {
            return redirect(route('invoices.index'));
        }
        return view('invoices.show')->with('invoices', $invoices);
    }

    public function edit($id): object
    {
        $invoices = $this->invoicesRepository->find($id);
        if (empty($invoices)) {
            return redirect(route('invoices.index'));
        }
        return view('invoices.edit')->with('invoices', $invoices);
    }

    public function update($id, Request $request): object
    {
        $invoices = $this->invoicesRepository->find($id);
        if (empty($invoices)) {
            return redirect(route('invoices.index'));
        }
        $result = $this->validating($request);
        $invoices = $this->invoicesRepository->update($request->all(), $id);
        return redirect(route('invoices.index'));
    }

    public function destroy($id): object
    {
        $invoices = $this->invoicesRepository->find($id);
        if (empty($invoices)) {
            return redirect(route('invoices.index'));
        }
        $this->invoicesRepository->delete($id);
        return redirect('invoices.index');
    }

    public static function DDDW(): array
    {
        return [" "] + Invoices::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function fields($invoice): array
    {
        $formGroupArray = [];
        $item = ["label" => Form::label('partner_id', 'Partner:'),
            "field" => Form::select('partner_id', SelectService::selectSupplier(), null,
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

    public function beforeInvoiceReferred($id, $route): object
    {
        $data = Invoices::find($id);
        SWAlertService::choice($id, is_null($data->referred_date) ? 'Biztosan utalta a tétel?' : 'Biztos visszavonja az utalást?', '/' . $route, 'Kilép', '/changeReferredDate/' . $id . '/' . $route, 'Váltás');

        return view(Config::get('LAYOUTS_SHOW'))->with('table', $data);
    }

    public function changeReferredDate($id, $route): object
    {
        $invoice = Invoices::find($id);
        if (empty($invoice)) {
            return redirect(route($route));
        }
        $referredDate = is_null($invoice->referred_date) ? now()->toDateString() : null;
        Invoices::where('id', $id)->update(['referred_date' => $referredDate]);

        if (Session::get('invoiceReferred') === "Yes") {
            return redirect(route('referredIndex'));
        } else {
            return redirect(route('invoicesIndex', ['year' => Session::get('invoiceYear'),
                                                         'partner' => Session::get('invoicePartner')]));
        }
    }

}



