<?php

namespace App\Http\Controllers;

use App\Classes\ToolsClass;
use App\Enums\ActiveEnum;
use App\Enums\PartnerTypeEnum;
use App\Http\Requests\CreatePartnersRequest;
use App\Http\Requests\UpdatePartnersRequest;
use App\Models\PartnerTypes;
use App\Repositories\PartnersRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Partners;
use App\Classes\SettlementsClass;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Form;
use App\Traits\Others\PartnerFactSheetTrait;
use App\Traits\Others\PartnerPeriodicAccountsTrait;

class PartnersController extends AppBaseController
{
    private $partnersRepository;
    private $delivery_customer;

    public function __construct(PartnersRepository $partnersRepo)
    {
        $this->partnersRepository = $partnersRepo;
        $this->delivery_customer = PartnerTypes::where('name', PartnerTypeEnum::DELIVERY_CUSTOMER->value)->first()->id;
    }

    use PartnerFactSheetTrait, PartnerPeriodicAccountsTrait;

    public function dwData($data): mixed
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('partnerTypesName', function ($data) {
                return ($data->partnertypes->name);
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('partners.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm  editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                if ($row->partnertypes_id != 5) {
                    if ($row->active == ActiveEnum::INACTIVE->value) {
                        if (ToolsClass::aviable($row->id)) {
                            $btn = $btn . '<a href="' . route('beforeDestroys', ['Partners', $row->id, 'partners']) . '"
                                             class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                        }
                        $btn = $btn . '<a href="' . route('beforePartnerActivation', [$row->id, 'partners']) . '"
                                         class="btn btn-warning btn-sm deleteProduct" title="Aktiválás"><i class="fas fa-user-check"></i></a>';
                    } else {
                        $btn = $btn . '<a href="' . route('beforePartnerActivation', [$row->id, 'partners']) . '"
                                         class="btn btn-warning btn-sm deleteProduct" title="Inaktiválás"><i class="fas fa-user-alt-slash"></i></a>';
                    }
                    $btn = $btn . '<a href="' . route('partners.show', [$row->id]) . '"
                                     class="btn btn-info btn-sm deleteProduct" title="Adatlap"><i class="fas fa-newspaper"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request, ?string $active = null): object
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return $this->dwData($this->getData($active));
            }
            return view('partners.index');
        }
        return view('partners.index');
    }

    public function getData(?string $active = null): object
    {
        if (is_null($active)) {
            return Partners::with('partnertypes')->where('partnertypes_id', '!=', $this->delivery_customer)->get();
        } else {
            if ($active == ActiveEnum::INACTIVE->value) {
                return Partners::with('partnertypes')->inactivePartner()->where('partnertypes_id', '!=', $this->delivery_customer)->get();
            } else {
                return Partners::with('partnertypes')->activePartner()->where('partnertypes_id', '!=', $this->delivery_customer)->get();
            }
        }
    }

    public function create(): object
    {
        return view('partners.create');
    }

    public function store(CreatePartnersRequest $request): object
    {
        $input = $request->all();
        $partners = $this->partnersRepository->create($input);
        return redirect(route('partners.index'));
    }

    public function show($id): object
    {
        $partners = $this->partnersRepository->find($id);
        if (empty($partners)) {
            return redirect(route('partners.index'));
        }
        return view('partners.show')->with('partners', $partners);
    }

    public function edit($id): object
    {
        $partners = $this->partnersRepository->find($id);
        if (empty($partners)) {
            return redirect(route('partners.index'));
        }
        return view('partners.edit')->with('partners', $partners);
    }

    public function update($id, UpdatePartnersRequest $request): object
    {
        $partners = $this->partnersRepository->find($id);
        if (empty($partners)) {
            return redirect(route('partners.index'));
        }
        $partners = $this->partnersRepository->update($request->all(), $id);

        return redirect(route('partners.index'));
    }

    public function destroy($id): object
    {
        $partners = $this->partnersRepository->find($id);
        if (empty($partners)) {
            return redirect(route('partners.index'));
        }
        $this->partnersRepository->delete($id);

        return redirect(route('partners.index'));
    }

    public static function DDDW(?int $partnertypes = null): array
    {
        return [" "] + Partners::where(function ($query) use ($partnertypes) {
                is_null($partnertypes) ? $query->whereNotNull('partnertypes_id') : $query->where('partnertypes_id', '=', $partnertypes);
            })->where('active', 'aktív')->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function withoutDeleiveryDDDW(?int $partnertypes = null): array
    {
        return [" "] + Partners::where('partnertypes_id', '!=', 10)
                ->where('active', 'aktív')
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray();
    }

    public static function fields($partners): array
    {
        $formGroupArray = [];
        $item = ["label" => Form::label('name', 'Név:'),
            "field" => Form::text('name', null, ['class' => 'form-control', 'maxlength' => 100, 'required' => true,
                'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('partnertypes_id', 'Típus:'),
            "field" => Form::select('partnertypes_id', PartnerTypesController::DDDW(), null,
                ['class' => 'select2 form-control', 'id' => 'partnertypes_id', 'required' => true, 'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('taxnumber', 'Adószám:'),
            "field" => Form::text('taxnumber', null, ['class' => 'form-control', 'maxlength' => 13, 'data-inputmask' => "'mask': '99999999-9-99'", 'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('bankaccount', 'Bankszámla:'),
            "field" => Form::text('bankaccount', null, ['class' => 'form-control', 'maxlength' => 26, 'data-inputmask' => "'mask': '99999999-99999999-99999999'", 'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        if (isset($partners) && $partners->active == 0) {
            $form = Form::text('postcode', $partners->postcode, ['class' => 'form-control', 'readonly' => true]);
        } else {
            $form = Form::select('postcode', SettlementsClass::settlementsPostcodeDDDW(), null,
                ['class' => 'select2 form-control', 'id' => 'postcode', 'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]);
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
                ['class' => 'select2 form-control', 'id' => 'settlement_id', 'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]);
        }
        $item = ["label" => Form::label('settlement_id', 'Város:'),
            "field" => $form,
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('address', 'Cím:'),
            "field" => Form::text('address', null, ['class' => 'form-control', 'maxlength' => 100, 'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('email', 'Email:'),
            "field" => Form::email('email', null, ['class' => 'form-control', 'maxlength' => 50, 'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        $item = ["label" => Form::label('phonenumber', 'Telefonszám:'),
            "field" => Form::text('phonenumber', null, ['class' => 'form-control', 'id' => 'phonenumber', 'maxlength' => 20, 'data-inputmask' => "'mask': '9999-99-999-9999'", 'readonly' => isset($partners) ? ($partners->active == ActiveEnum::ACTIVE ? false : true) : false]),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::label('description', 'Megjegyzés:'),
            "field" => Form::textarea('description', null, ['class' => 'form-control', 'maxlength' => 500, 'rows' => 4, 'id' => 'description']),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);

        $item = ["label" => Form::hidden('active', 'AKtív:'),
            "field" => Form::hidden('active', isset($partners) ? $partners->active->value : 'aktív', ['class' => 'form-control', 'id' => 'active']),
            "width" => 6,
            "file" => false];
        array_push($formGroupArray, $item);
        return $formGroupArray;
    }

    public function postcodeSettlementDDDW(Request $request): object
    {
        return SettlementsClass::postcodeSettlementDDDW($request->get('postcode'));
    }

    public function settlementPostcodeByDDDW(Request $request): object
    {
        return SettlementsClass::settlementPostcodeByDDDW($request->get('id'));
    }
}
