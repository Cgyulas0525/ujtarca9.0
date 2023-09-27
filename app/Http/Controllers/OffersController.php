<?php

namespace App\Http\Controllers;

use App\Actions\OfferPdfAction;
use App\Classes\OfferClass;
use App\Events\SendMail;
use App\Http\Requests\CreateOffersRequest;
use App\Http\Requests\UpdateOffersRequest;
use App\Models\Offerdetails;
use App\Models\Partners;
use App\Repositories\OffersRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Offers;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use PDF;
use Mail;
use Event;

use App\Traits\OfferEmailTrait;

class OffersController extends AppBaseController
{
    /** @var OffersRepository $offersRepository */
    private $offersRepository;
    private $offer;
    private $owner;
    private $partner;
    private $details;

    public function __construct(OffersRepository $offersRepo)
    {
        $this->offersRepository = $offersRepo;
    }

    use OfferEmailTrait;

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('sumPrice', function ($data) {
                return OfferClass::sumOfferSupplierPrice($data->id);
            })
            ->addColumn('partnerName', function ($data) {
                return $data->partners->name;
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('offers.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Offers', $row->id, 'offers']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                $btn = $btn . '<a href="' . route('offerPrint', [$row->id]) . '"
                                 class="btn btn-warning btn-sm deleteProduct" title="Nyomtatás"><i class="fas fa-print"></i></a>';
                $btn = $btn . '<a href="' . route('offerEmail', [$row->id]) . '"
                                 class="btn btn-warning btn-sm deleteProduct" title="Email"><i class="fas fa-envelope-open"></i></a>';
                $btn = $btn . '<a href="' . route('offerReplay', [$row->id]) . '"
                                 class="btn btn-primary btn-sm deleteProduct" title="Ismétlés"><i class="fas fa-copy"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return $this->dwData(Offers::with('partners')->get());
            }
            return view('offers.index');
        }
    }

    public function create()
    {
        return view('offers.create');
    }

    public function store(CreateOffersRequest $request)
    {
        $input = $request->all();
        $offers = $this->offersRepository->create($input);
        return redirect(route('offers.index'));
    }

    public function show($id)
    {
        $offers = $this->offersRepository->find($id);
        if (empty($offers)) {
            return redirect(route('offers.index'));
        }
        return view('offers.show')->with('offers', $offers);
    }

    public function edit($id)
    {
        $offers = $this->offersRepository->find($id);
        if (empty($offers)) {
            return redirect(route('offers.index'));
        }
        return view('offers.edit')->with('offers', $offers);
    }

    public function offersEdit($id)
    {
        $offers = $this->offersRepository->find($id);
        if (empty($offers)) {
            return redirect(route('offers.index'));
        }
        return view('offers.edit')->with('offers', $offers);
    }

    public function update($id, UpdateOffersRequest $request)
    {
        $offers = $this->offersRepository->find($id);
        if (empty($offers)) {
            return redirect(route('offers.index'));
        }
        $offers = $this->offersRepository->update($request->all(), $id);
        return redirect(route('offers.index'));
    }

    public function destroy($id)
    {
        $offers = $this->offersRepository->find($id);
        if (empty($offers)) {
            return redirect(route('offers.index'));
        }
        $this->offersRepository->delete($id);
        return redirect(route('offers.index'));
    }

    public static function DDDW(): array
    {
        return [" "] + offers::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function print($id)
    {
        $this->offer = Offers::find($id);
        $this->owner = Partners::where('partnertypes_id', 5)->first();
        $this->partner = Partners::find($this->offer->partners_id);
        $this->details = Offerdetails::where('offers_id', $this->offer->id)->get();

        return view('printing.offerPrint')->with(['offer' => $this->offer, 'owner' => $this->owner, 'partner' => $this->partner, 'details' => $this->details]);
    }
}



