<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Repositories\ProductsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Products;
use App\Models\Partners;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use PDF;
use Mail;

class ProductsController extends AppBaseController
{
    /** @var ProductsRepository $productsRepository*/
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepo)
    {
        $this->productsRepository = $productsRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('products.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Products', $row->id, 'products']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Products.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('products as t1')
                    ->join('quantities as t2', 't2.id', '=', 't1.quantities_id')
                    ->select('t1.*', 't2.name as quantityName')
                    ->whereNull('t1.deleted_at')
                    ->get();
                return $this->dwData($data);

            }

            return view('products.index');
        }
    }

    /**
     * Show the form for creating a new Products.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created Products in storage.
     *
     * @param CreateProductsRequest $request
     *
     * @return Response
     */
    public function store(CreateProductsRequest $request)
    {
        $input = $request->all();

        $products = $this->productsRepository->create($input);

        return redirect(route('products.index'));
    }

    /**
     * Display the specified Products.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $products = $this->productsRepository->find($id);

        if (empty($products)) {
            return redirect(route('products.index'));
        }

        return view('products.show')->with('products', $products);
    }

    /**
     * Show the form for editing the specified Products.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $products = $this->productsRepository->find($id);

        if (empty($products)) {
            return redirect(route('products.index'));
        }

        return view('products.edit')->with('products', $products);
    }

    /**
     * Update the specified Products in storage.
     *
     * @param int $id
     * @param UpdateProductsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductsRequest $request)
    {
        $products = $this->productsRepository->find($id);

        if (empty($products)) {
            return redirect(route('products.index'));
        }

        $products = $this->productsRepository->update($request->all(), $id);

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Products from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $products = $this->productsRepository->find($id);

        if (empty($products)) {
            return redirect(route('products.index'));
        }

        $this->productsRepository->delete($id);

        return redirect(route('products.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW() : array
    {
        return [" "] + products::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function print() {

        return view('printing.productsPrint')->with(['products' => Products::all()]);

    }

    public function pdfEmail()
    {
        $owner = Partners::where('partnertypes_id', 5)->first();
        $partners = Partners::where('partnertypes_id', 3)->get();

        foreach ($partners as $partner) {

            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                ->loadView('printing.productsPrintingEmail', ['owner' => $owner,
                                                             'partner' => $partner,
                                                             'products' => Products::all()]);

            $fileName = $partner->name . '-' . date('Y-m-d',strtotime('today')) .'-pékáru.pdf';
            $path = public_path('print/'.$fileName);

            $pdf->save($path);

            $data["email"] = $partner->email;
            $data["title"] = $owner->name.' pékáru lista!';
            $data["body"] = $owner->name.' új pékáru listát küldött Önnek.';
            $data["ugyfel"] = $owner->name;
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

        }

        return back();
    }

}



