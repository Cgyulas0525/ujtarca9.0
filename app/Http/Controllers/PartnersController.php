<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePartnersRequest;
use App\Http\Requests\UpdatePartnersRequest;
use App\Models\PartnerTypes;
use App\Repositories\PartnersRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Partners;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Classes\SettlementsClass;

use Form;

class PartnersController extends AppBaseController
{
    /** @var PartnersRepository $partnersRepository*/
    private $partnersRepository;

    public function __construct(PartnersRepository $partnersRepo)
    {
        $this->partnersRepository = $partnersRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('partners.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Partners', $row["id"], 'partners']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Partners.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->partnersRepository->all();
                return $this->dwData($data);

            }

            return view('partners.index');
        }
    }

    /**
     * Show the form for creating a new Partners.
     *
     * @return Response
     */
    public function create()
    {
        return view('partners.create');
    }

    /**
     * Store a newly created Partners in storage.
     *
     * @param CreatePartnersRequest $request
     *
     * @return Response
     */
    public function store(CreatePartnersRequest $request)
    {
        $input = $request->all();

        $partners = $this->partnersRepository->create($input);

        return redirect(route('partners.index'));
    }

    /**
     * Display the specified Partners.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $partners = $this->partnersRepository->find($id);

        if (empty($partners)) {
            return redirect(route('partners.index'));
        }

        return view('partners.show')->with('partners', $partners);
    }

    /**
     * Show the form for editing the specified Partners.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $partners = $this->partnersRepository->find($id);

        if (empty($partners)) {
            return redirect(route('partners.index'));
        }

        return view('partners.edit')->with('partners', $partners);
    }

    /**
     * Update the specified Partners in storage.
     *
     * @param int $id
     * @param UpdatePartnersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePartnersRequest $request)
    {
        $partners = $this->partnersRepository->find($id);

        if (empty($partners)) {
            return redirect(route('partners.index'));
        }

        $partners = $this->partnersRepository->update($request->all(), $id);

        return redirect(route('partners.index'));
    }

    /**
     * Remove the specified Partners from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $partners = $this->partnersRepository->find($id);

        if (empty($partners)) {
            return redirect(route('partners.index'));
        }

        $this->partnersRepository->delete($id);

        return redirect(route('partners.index'));
    }

        /*
         * Dropdown for field select
         *
         * return array
         */
        public static function DDDW() : array
        {
            return [" "] + partners::orderBy('name')->pluck('name', 'id')->toArray();
        }

    public static function fields() {
        $formGroupArray = [];
        $item = ["label" => Form::label('name', 'Név:'),
            "field" => Form::text('name', null, ['class' => 'form-control','maxlength' => 100]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('partnertypes_id', 'Típus:'),
            "field" => Form::select('partnertypes_id', PartnerTypesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'partnertypes_id', 'required' => true]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('taxnumber', 'Adószám:'),
            "field" => Form::text('taxnumber', null, ['class' => 'form-control','maxlength' => 13, 'data-inputmask'=>"'mask': '99999999-9-99'"]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('bankaccount', 'Bankszámla:'),
            "field" => Form::text('bankaccount', null, ['class' => 'form-control','maxlength' => 26, 'data-inputmask'=>"'mask': '99999999-99999999-99999999'"]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('postcode', 'Irányító szám:'),
            "field" => Form::select('postcode', SettlementsClass::settlementsPostcodeDDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'postcode', 'required' => true]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('settlement_id', 'Város:'),
            "field" => Form::select('settlement_id', SettlementsClass::settlementsDDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'settlement_id', 'required' => true]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('address', 'Cím:'),
            "field" => Form::text('address', null, ['class' => 'form-control','maxlength' => 100]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('email', 'Email:'),
            "field" => Form::email('email', null, ['class' => 'form-control','maxlength' => 50]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('phonenumber', 'Telefonszám:'),
            "field" => Form::text('phonenumber', null, ['class' => 'form-control', 'id' => 'phonenumber','maxlength' => 20, 'data-inputmask'=>"'mask': '9999-99-999-9999'"]),
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

    public function postcodeSettlementDDDW(Request $request) {
        return SettlementsClass::postcodeSettlementDDDW($request->get('postcode'));
    }

}
