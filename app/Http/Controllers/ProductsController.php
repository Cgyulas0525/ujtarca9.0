<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Repositories\ProductsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Products;

use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use DataTables;

use App\Traits\ProductPdfEmailTrait;

class ProductsController extends AppBaseController
{
    /** @var ProductsRepository $productsRepository*/
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepo)
    {
        $this->productsRepository = $productsRepo;
    }

    use ProductPdfEmailTrait;

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('quantityName', function($data) { return ($data->quantities->name); })
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

    public function index(Request $request)
    {
        if( Auth::check() ){
            if ($request->ajax()) {
                return $this->dwData(Products::with('quantities')->get());
            }
            return view('products.index');
        }
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(CreateProductsRequest $request)
    {
        $input = $request->all();
        $products = $this->productsRepository->create($input);
        return redirect(route('products.index'));
    }

    public function show($id)
    {
        $products = $this->productsRepository->find($id);
        if (empty($products)) {
            return redirect(route('products.index'));
        }
        return view('products.show')->with('products', $products);
    }

    public function edit($id)
    {
        $products = $this->productsRepository->find($id);
        if (empty($products)) {
            return redirect(route('products.index'));
        }
        return view('products.edit')->with('products', $products);
    }

    public function update($id, UpdateProductsRequest $request)
    {
        $products = $this->productsRepository->find($id);
        if (empty($products)) {
            return redirect(route('products.index'));
        }
        $products = $this->productsRepository->update($request->all(), $id);
        return redirect(route('products.index'));
    }

    public function destroy($id)
    {
        $products = $this->productsRepository->find($id);
        if (empty($products)) {
            return redirect(route('products.index'));
        }
        $this->productsRepository->delete($id);
        return redirect(route('products.index'));
    }

    public static function DDDW() : array
    {
        return [" "] + Products::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function offerDetailsProductsDDDW($offerId) : array
    {
        return [" "] + DB::table('products')
                         ->whereNull('deleted_at')
                         ->whereNotIn('id', function ($query) use($offerId) {
                             return $query->from('offerdetails')->select('offerdetails.products_id')->where('offerdetails.offers_id', $offerId)->get();
                         })->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public static function orderDetailsProductsDDDW($orderId) : array
    {
        return [" "] + DB::table('products')
                         ->whereNull('deleted_at')
                         ->whereNotIn('id', function ($query) use($orderId) {
                             return $query->from('orderdetails')->select('orderdetails.products_id')->where('orderdetails.orders_id', $orderId)->get();
                         })->orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function print() {
        return view('printing.productsPrint')->with(['products' => Products::all()]);
    }

}



