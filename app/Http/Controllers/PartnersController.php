<?php

namespace App\Http\Controllers;

use App\Classes\ToolsClass;
use App\Http\Requests\CreatePartnersRequest;
use App\Http\Requests\UpdatePartnersRequest;
use App\Repositories\PartnersRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Partners;

use App\Classes\SettlementsClass;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use Form;

use App\Traits\Others\PartnerFactSheetTrait;

class PartnersController extends AppBaseController
{
    /** @var PartnersRepository $partnersRepository*/
    private $partnersRepository;

    public function __construct(PartnersRepository $partnersRepo)
    {
        $this->partnersRepository = $partnersRepo;
    }

    use PartnerFactSheetTrait;

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('partners.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm  editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                if ($row->partnertypes_id != 5) {
                    if ($row->active == 0) {
                        if (ToolsClass::aviable($row->id)) {
                            $btn = $btn.'<a href="' . route('beforeDestroys', ['Partners', $row->id, 'partners']) . '"
                                             class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                        }
                        $btn = $btn.'<a href="' . route('beforePartnerActivation', [$row->id, 'partners']) . '"
                                         class="btn btn-warning btn-sm deleteProduct" title="Aktiválás"><i class="fas fa-user-check"></i></a>';
                    } else {
                        $btn = $btn.'<a href="' . route('beforePartnerActivation', [$row->id, 'partners']) . '"
                                         class="btn btn-warning btn-sm deleteProduct" title="Deaktiválás"><i class="fas fa-user-alt-slash"></i></a>';
                    }
                    $btn = $btn.'<a href="' . route('partners.show', [$row->id]) . '"
                                     class="btn btn-info btn-sm deleteProduct" title="Adatlap"><i class="fas fa-newspaper"></i></a>';
                }
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

                $data = DB::table('partners as t1')
                          ->join('partnertypes as t2', 't2.id', '=', 't1.partnertypes_id')
                          ->select('t1.*', 't2.name as partnerTypesName')
                          ->whereNull('t1.deleted_at')
                          ->where('t1.active', 1)
                          ->get();
                return $this->dwData($data);

            }

            return view('partners.index');
        }
    }

    public function partnersIndex(Request $request, $active = null)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('partners as t1')
                          ->join('partnertypes as t2', 't2.id', '=', 't1.partnertypes_id')
                          ->select('t1.*', 't2.name as partnerTypesName')
                          ->whereNull('t1.deleted_at')
                          ->where( function($query) use ($active) {
                              if (is_null($active) || $active == -9999 ) {
                                  $query->whereNotNull('t1.active');
                              } else {
                                  $query->where('t1.active', '=', $active);
                              }
                          })
                          ->get();
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
    public static function DDDW($partnertypes = null) : array
    {
        return [" "] + Partners::where( function($query) use ($partnertypes) {
                if (is_null($partnertypes)) {
                    $query->whereNotNull('partnertypes_id');
                } else {
                    $query->where('partnertypes_id', '=', $partnertypes);
                }
            })
            ->where('active', 1)->orderBy('name')->pluck('name', 'id')->toArray();
    }


    public static function DDDWSupplier() : array
    {
        return [" "] + Partners::whereIn( 'partnertypes_id', [1,2,4,6,7,8])
                ->where('active', 1)->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function fields($partners) : array{
        $formGroupArray = [];
        $item = ["label" => Form::label('name', 'Név:'),
            "field" => Form::text('name', null, ['class' => 'form-control','maxlength' => 100,
                                        'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('partnertypes_id', 'Típus:'),
            "field" => Form::select('partnertypes_id', PartnerTypesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'partnertypes_id', 'required' => true, 'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('taxnumber', 'Adószám:'),
            "field" => Form::text('taxnumber', null, ['class' => 'form-control','maxlength' => 13, 'data-inputmask'=>"'mask': '99999999-9-99'", 'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('bankaccount', 'Bankszámla:'),
            "field" => Form::text('bankaccount', null, ['class' => 'form-control','maxlength' => 26, 'data-inputmask'=>"'mask': '99999999-99999999-99999999'", 'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        if (isset($partners) && $partners->active == 0) {
            $form = Form::text('postcode', $partners->postcode, ['class' => 'form-control', 'readonly' => true]);
        } else {
            $form = Form::select('postcode', SettlementsClass::settlementsPostcodeDDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'postcode', 'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]);
        }
        $item = ["label" => Form::label('postcode', 'Irányító szám:'),
            "field" => $form,
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        if (isset($partners) && $partners->active == 0) {
            $form = Form::text('settlement_id', $partners->settlementName, ['class' => 'form-control', 'readonly' => true]);
        } else {
            $form = Form::select('settlement_id', SettlementsClass::settlementsDDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'settlement_id', 'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]);
        }
        $item = ["label" => Form::label('settlement_id', 'Város:'),
            "field" => $form,
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('address', 'Cím:'),
            "field" => Form::text('address', null, ['class' => 'form-control','maxlength' => 100, 'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('email', 'Email:'),
            "field" => Form::email('email', null, ['class' => 'form-control','maxlength' => 50, 'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('phonenumber', 'Telefonszám:'),
            "field" => Form::text('phonenumber', null, ['class' => 'form-control', 'id' => 'phonenumber','maxlength' => 20, 'data-inputmask'=>"'mask': '9999-99-999-9999'", 'readonly' => isset($partners) ? ($partners->active == 1 ? false : true)  : false]),
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
