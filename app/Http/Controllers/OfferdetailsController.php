<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOfferdetailsRequest;
use App\Http\Requests\UpdateOfferdetailsRequest;
use App\Repositories\OfferdetailsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Offerdetails;
use App\Models\Offers;

use Illuminate\Http\Request;
use Response;
use Auth;
use DataTables;

class OfferdetailsController extends AppBaseController
{
    /** @var OfferdetailsRepository $offerdetailsRepository */
    private $offerdetailsRepository;

    public function __construct(OfferdetailsRepository $offerdetailsRepo)
    {
        $this->offerdetailsRepository = $offerdetailsRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('productName', function($data) { return $data->produts->name; })
            ->addColumn('quantityName', function($data) { return $data->quantities->name; })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('offerdetails.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Offerdetails', $row["id"], 'offerdetails']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return $this->dwData(Offerdetails::with('products')->with('quantities')->get());
            }
            return view('offerdetails.index');
        }
    }

    public function offerdetailsIndex(Request $request, $id)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return Datatables::of(Offerdetails::with('products')->with('quantities')->where('offers_id', $id)->get())
                    ->addIndexColumn()
                    ->addColumn('productName', function($data) { return $data->produts->name; })
                    ->addColumn('quantityName', function($data) { return $data->quantities->name; })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('beforeDestroysWithParam', ['Offerdetails', $row->id, 'offersEdit', $row->offers_id]) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('offerdetails.index');
        }
    }

    public function create()
    {
        return view('offerdetails.create');
    }

    public function offerdetailsCreate($id)
    {
        $offers = Offers::find($id);
        return view('offerdetails.create')->with('offers', $offers);
    }

    public function store(CreateOfferdetailsRequest $request)
    {
        $input = $request->all();
        $offerdetails = $this->offerdetailsRepository->create($input);
        $offers = Offers::find($offerdetails->offers_id);
        return view('offerdetails.create')->with('offers', $offers);
    }

    public function show($id)
    {
        $offerdetails = $this->offerdetailsRepository->find($id);
        if (empty($offerdetails)) {
            return redirect(route('offerdetails.index'));
        }
        return view('offerdetails.show')->with('offerdetails', $offerdetails);
    }

    public function edit($id)
    {
        $offerdetails = $this->offerdetailsRepository->find($id);
        if (empty($offerdetails)) {
            return redirect(route('offerdetails.index'));
        }
        return view('offerdetails.edit')->with('offerdetails', $offerdetails);
    }

    public function update($id, UpdateOfferdetailsRequest $request)
    {
        $offerdetails = $this->offerdetailsRepository->find($id);
        if (empty($offerdetails)) {
            return redirect(route('offerdetails.index'));
        }
        $offerdetails = $this->offerdetailsRepository->update($request->all(), $id);
        return redirect(route('offerdetails.index'));
    }

    public function destroy($id)
    {
        $offerdetails = $this->offerdetailsRepository->find($id);
        if (empty($offerdetails)) {
            return redirect(route('offerdetails.index'));
        }
        $this->offerdetailsRepository->delete($id);
        return redirect(route('offerdetails.index'));
    }

    public static function DDDW(): array
    {
        return [" "] + offerdetails::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function offerDetailsUpdate(Request $request): mixed
    {
        $offerdetail = Offerdetails::find($request->get('id'));
        $offerdetail->value = $request->get('value');
        $offerdetail->updated_at = \Carbon\Carbon::now();
        $offerdetail->save();

        return Response::json(Offerdetails::find($request->get('id')));

    }
}



