<?php

namespace App\Http\Controllers;

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

class OffersController extends AppBaseController
{
    /** @var OffersRepository $offersRepository*/
    private $offersRepository;
    private $offer;
    private $owner;
    private $partner;
    private $details;


    public function __construct(OffersRepository $offersRepo)
    {
        $this->offersRepository = $offersRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('offers.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Offers', $row->id, 'offers']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                $btn = $btn.'<a href="' . route('offerPrint', [$row->id]) . '"
                                 class="btn btn-warning btn-sm deleteProduct" title="Nyomtatás"><i class="fas fa-print"></i></a>';
                $btn = $btn.'<a href="' . route('offerEmail', [$row->id]) . '"
                                 class="btn btn-warning btn-sm deleteProduct" title="Email"><i class="fas fa-envelope-open"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Offers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('offers as t1')
                    ->join('partners as t2', 't2.id', '=', 't1.partners_id')
                    ->select('t1.*', 't2.name as partnerName')
                    ->whereNull('t1.deleted_at')
                    ->get();
                return $this->dwData($data);

            }

            return view('offers.index');
        }
    }

    /**
     * Show the form for creating a new Offers.
     *
     * @return Response
     */
    public function create()
    {
        return view('offers.create');
    }

    /**
     * Store a newly created Offers in storage.
     *
     * @param CreateOffersRequest $request
     *
     * @return Response
     */
    public function store(CreateOffersRequest $request)
    {
        $input = $request->all();

        $offers = $this->offersRepository->create($input);

        return redirect(route('offers.index'));
    }

    /**
     * Display the specified Offers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offers = $this->offersRepository->find($id);

        if (empty($offers)) {
            return redirect(route('offers.index'));
        }

        return view('offers.show')->with('offers', $offers);
    }

    /**
     * Show the form for editing the specified Offers.
     *
     * @param int $id
     *
     * @return Response
     */
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

    /**
     * Update the specified Offers in storage.
     *
     * @param int $id
     * @param UpdateOffersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOffersRequest $request)
    {
        $offers = $this->offersRepository->find($id);

        if (empty($offers)) {
            return redirect(route('offers.index'));
        }

        $offers = $this->offersRepository->update($request->all(), $id);

        return redirect(route('offers.index'));
    }

    /**
     * Remove the specified Offers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $offers = $this->offersRepository->find($id);

        if (empty($offers)) {
            return redirect(route('offers.index'));
        }

        $this->offersRepository->delete($id);

        return redirect(route('offers.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW() : array
    {
        return [" "] + offers::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function init($id) : void {
        $this->offer = Offers::find($id);
        $this->owner = Partners::where('partnertypes_id', 5)->first();
        $this->partner = Partners::find($this->offer->partners_id);
        $this->details = Offerdetails::where('offers_id', $this->offer->id)->get();
    }

    public function print($id) {
        $this->init($id);
        return view('printing.offerPrint')->with(['offer' => $this->offer, 'owner' => $this->owner, 'partner' => $this->partner, 'details' => $this->details]);

    }

    public function offerEmail($id)
    {
        $this->init($id);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('printing.offerPrintingEmail', ['offer' => $this->offer, 'owner' => $this->owner, 'partner' => $this->partner, 'details' => $this->details]);

            $fileName = $this->partner->name . '-' . $this->offer->offernumber . '-' . date('Y-m-d',strtotime('today')) .'-megrendelés.pdf';
            $path = public_path('print/'.$fileName);

        $pdf->save($path);

        $data["email"] = $this->partner->email;
        $data["title"] = $this->owner->name.' megrendelés!';
        $data["body"] = $this->owner->name.' új megrendelést küldött Önnek.';
        $data["ugyfel"] = $this->owner->name;
        $data["datum"] = date('Y-m-d');

        $files = [
            $path,
        ];

        Mail::send('emails.pekaruMail', $data, function($message) use($data, $files) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"]);

            foreach ($files as $file){
                $message->attach($file);
            }
        });

        return back();
    }


}



