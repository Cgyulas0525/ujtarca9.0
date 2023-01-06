<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePaymentMethodsRequest;
use App\Http\Requests\UpdatePaymentMethodsRequest;
use App\Repositories\PaymentMethodsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\PaymentMethods;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use Form;

class PaymentMethodsController extends AppBaseController
{
    /** @var PaymentMethodsRepository $paymentMethodsRepository*/
    private $paymentMethodsRepository;

    public function __construct(PaymentMethodsRepository $paymentMethodsRepo)
    {
        $this->paymentMethodsRepository = $paymentMethodsRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('paymentMethods.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['PaymentMethods', $row["id"], 'paymentMethods']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the PaymentMethods.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->paymentMethodsRepository->all();
                return $this->dwData($data);

            }

            return view('payment_methods.index');
        }
    }

    /**
     * Show the form for creating a new PaymentMethods.
     *
     * @return Response
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created PaymentMethods in storage.
     *
     * @param CreatePaymentMethodsRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentMethodsRequest $request)
    {
        $input = $request->all();

        $paymentMethods = $this->paymentMethodsRepository->create($input);

        return redirect(route('paymentMethods.index'));
    }

    /**
     * Display the specified PaymentMethods.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paymentMethods = $this->paymentMethodsRepository->find($id);

        if (empty($paymentMethods)) {
            return redirect(route('paymentMethods.index'));
        }

        return view('payment_methods.show')->with('paymentMethods', $paymentMethods);
    }

    /**
     * Show the form for editing the specified PaymentMethods.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paymentMethods = $this->paymentMethodsRepository->find($id);

        if (empty($paymentMethods)) {
            return redirect(route('paymentMethods.index'));
        }

        return view('payment_methods.edit')->with('paymentMethods', $paymentMethods);
    }

    /**
     * Update the specified PaymentMethods in storage.
     *
     * @param int $id
     * @param UpdatePaymentMethodsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentMethodsRequest $request)
    {
        $paymentMethods = $this->paymentMethodsRepository->find($id);

        if (empty($paymentMethods)) {
            return redirect(route('paymentMethods.index'));
        }

        $paymentMethods = $this->paymentMethodsRepository->update($request->all(), $id);

        return redirect(route('paymentMethods.index'));
    }

    /**
     * Remove the specified PaymentMethods from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $paymentMethods = $this->paymentMethodsRepository->find($id);

        if (empty($paymentMethods)) {
            return redirect(route('paymentMethods.index'));
        }

        $this->paymentMethodsRepository->delete($id);

        return redirect(route('paymentMethods.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW() : array
    {
        return [" "] + paymentMethods::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function fields() {
        $formGroupArray = [];
        $item = ["label" => Form::label('name', 'Név:'),
            "field" => Form::text('name', null, ['class' => 'form-control','maxlength' => 100]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('description', 'Megjegyzés:'),
            "field" => Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4, 'id' => 'description']),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        return $formGroupArray;
    }
}



