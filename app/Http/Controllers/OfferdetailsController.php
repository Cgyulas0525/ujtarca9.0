<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOfferdetailsRequest;
use App\Http\Requests\UpdateOfferdetailsRequest;
use App\Repositories\OfferdetailsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Offerdetails;
use App\Models\Offers;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class OfferdetailsController extends AppBaseController
{
    /** @var OfferdetailsRepository $offerdetailsRepository*/
    private $offerdetailsRepository;

    public function __construct(OfferdetailsRepository $offerdetailsRepo)
    {
        $this->offerdetailsRepository = $offerdetailsRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('offerdetails.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Offerdetails', $row["id"], 'offerdetails']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Offerdetails.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('offerdetails as t1')
                          ->join('products as t2', 't2.id', '=', 't1.products_id')
                          ->join('quantities as t3', 't3.id', '=', 't1.quantities_id')
                          ->select('t1.*', 't2.name as productName', 't3.name as quantityName')
                          ->whereNull('t1.deleted_at')
                          ->get();
                return $this->dwData($data);

            }

            return view('offerdetails.index');
        }
    }

    /**
     * Display a listing of the Offerdetails.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function offerdetailsIndex(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('offerdetails as t1')
                    ->join('products as t2', 't2.id', '=', 't1.products_id')
                    ->join('quantities as t3', 't3.id', '=', 't1.quantities_id')
                    ->select('t1.*', 't2.name as productName', 't3.name as quantityName')
                    ->where('t1.offers_id', $id)
                    ->whereNull('t1.deleted_at')
                    ->get();
                return $this->dwData($data);

            }

            return view('offerdetails.index');
        }
    }

    /**
     * Show the form for creating a new Offerdetails.
     *
     * @return Response
     */
    public function create()
    {
        return view('offerdetails.create');
    }

    /**
     * Show the form for creating a new Offerdetails.
     *
     * @return Response
     */
    public function offerdetailsCreate($id)
    {
        $offers = Offers::find($id);
        return view('offerdetails.create')->with('offers', $offers);
    }

    /**
     * Store a newly created Offerdetails in storage.
     *
     * @param CreateOfferdetailsRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferdetailsRequest $request)
    {
        $input = $request->all();

        $offerdetails = $this->offerdetailsRepository->create($input);

        return redirect(route('offerdetails.index'));
    }

    /**
     * Display the specified Offerdetails.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offerdetails = $this->offerdetailsRepository->find($id);

        if (empty($offerdetails)) {
            return redirect(route('offerdetails.index'));
        }

        return view('offerdetails.show')->with('offerdetails', $offerdetails);
    }

    /**
     * Show the form for editing the specified Offerdetails.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offerdetails = $this->offerdetailsRepository->find($id);

        if (empty($offerdetails)) {
            return redirect(route('offerdetails.index'));
        }

        return view('offerdetails.edit')->with('offerdetails', $offerdetails);
    }

    /**
     * Update the specified Offerdetails in storage.
     *
     * @param int $id
     * @param UpdateOfferdetailsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferdetailsRequest $request)
    {
        $offerdetails = $this->offerdetailsRepository->find($id);

        if (empty($offerdetails)) {
            return redirect(route('offerdetails.index'));
        }

        $offerdetails = $this->offerdetailsRepository->update($request->all(), $id);

        return redirect(route('offerdetails.index'));
    }

    /**
     * Remove the specified Offerdetails from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offerdetails = $this->offerdetailsRepository->find($id);

        if (empty($offerdetails)) {
            return redirect(route('offerdetails.index'));
        }

        $this->offerdetailsRepository->delete($id);

        return redirect(route('offerdetails.index'));
    }

        /*
         * Dropdown for field select
         *
         * return array
         */
        public static function DDDW() : array
        {
            return [" "] + offerdetails::orderBy('name')->pluck('name', 'id')->toArray();
        }
}



