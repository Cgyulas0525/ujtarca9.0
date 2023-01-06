<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePartnerTypesRequest;
use App\Http\Requests\UpdatePartnerTypesRequest;
use App\Repositories\PartnerTypesRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\PartnerTypes;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use Form;

class PartnerTypesController extends AppBaseController
{
    /** @var PartnerTypesRepository $partnerTypesRepository*/
    private $partnerTypesRepository;

    public function __construct(PartnerTypesRepository $partnerTypesRepo)
    {
        $this->partnerTypesRepository = $partnerTypesRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('partnerTypes.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['PartnerTypes', $row["id"], 'partnerTypes']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the PartnerTypes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->partnerTypesRepository->all();
                return $this->dwData($data);

            }

            return view('partner_types.index');
        }
    }

    /**
     * Show the form for creating a new PartnerTypes.
     *
     * @return Response
     */
    public function create()
    {
        return view('partner_types.create');
    }

    /**
     * Store a newly created PartnerTypes in storage.
     *
     * @param CreatePartnerTypesRequest $request
     *
     * @return Response
     */
    public function store(CreatePartnerTypesRequest $request)
    {
        $input = $request->all();

        $partnerTypes = $this->partnerTypesRepository->create($input);

        return redirect(route('partnerTypes.index'));
    }

    /**
     * Display the specified PartnerTypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $partnerTypes = $this->partnerTypesRepository->find($id);

        if (empty($partnerTypes)) {
            return redirect(route('partnerTypes.index'));
        }

        return view('partner_types.show')->with('partnerTypes', $partnerTypes);
    }

    /**
     * Show the form for editing the specified PartnerTypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $partnerTypes = $this->partnerTypesRepository->find($id);

        if (empty($partnerTypes)) {
            return redirect(route('partnerTypes.index'));
        }

        return view('partner_types.edit')->with('partnerTypes', $partnerTypes);
    }

    /**
     * Update the specified PartnerTypes in storage.
     *
     * @param int $id
     * @param UpdatePartnerTypesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePartnerTypesRequest $request)
    {
        $partnerTypes = $this->partnerTypesRepository->find($id);

        if (empty($partnerTypes)) {
            return redirect(route('partnerTypes.index'));
        }

        $partnerTypes = $this->partnerTypesRepository->update($request->all(), $id);

        return redirect(route('partnerTypes.index'));
    }

    /**
     * Remove the specified PartnerTypes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $partnerTypes = $this->partnerTypesRepository->find($id);

        if (empty($partnerTypes)) {
            return redirect(route('partnerTypes.index'));
        }

        $this->partnerTypesRepository->delete($id);

        return redirect(route('partnerTypes.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW() : array
    {
        return [" "] + partnerTypes::orderBy('name')->pluck('name', 'id')->toArray();
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



