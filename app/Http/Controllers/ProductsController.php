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
    /** @var ProductsRepository $productsRepository */
    private $productsRepository;

    public function __construct(ProductsRepository $productsRepo)
    {
        $this->productsRepository = $productsRepo;
    }

    use ProductPdfEmailTrait;

    public function dwData($data): mixed
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('quantityName', function ($data) {
                return ($data->quantities->name);
            })
            ->addColumn('activeName', function ($data) {
                return ($data->active->value);
            })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('products.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                if ($row->active == 0) {
                    $btn = $btn . '<a href="' . route('beforeProductActivation', [$row->id, 'products']) . '"
                                         class="btn btn-warning btn-sm deleteProduct" title="Aktiválás"><i class="fas fa-user-check"></i></a>';
                } else {
                    $btn = $btn . '<a href="' . route('beforeProductActivation', [$row->id, 'products']) . '"
                                         class="btn btn-warning btn-sm deleteProduct" title="Inaktiválás"><i class="fas fa-user-alt-slash"></i></a>';
                }
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Products', $row->id, 'products']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index(Request $request, ?string $active = null): object
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                if (is_null($active)) {
                    return $this->dwData(Products::with('quantities')->get());
                } else {
                    return $this->dwData(Products::with('quantities')->where('active', $active)->get());
                }
            }
            return view('products.index');
        }
    }

    public function create(): object
    {
        return view('products.create');
    }

    public function store(CreateProductsRequest $request): object
    {
        $input = $request->all();
        $products = $this->productsRepository->create($input);
        return redirect(route('products.index'));
    }

    public function show($id): object
    {
        $products = $this->productsRepository->find($id);
        if (empty($products)) {
            return redirect(route('products.index'));
        }
        return view('products.show')->with('products', $products);
    }

    public function edit($id): object
    {
        $products = $this->productsRepository->find($id);
        if (empty($products)) {
            return redirect(route('products.index'));
        }
        return view('products.edit')->with('products', $products);
    }

    public function update($id, UpdateProductsRequest $request): object
    {
        $products = $this->productsRepository->find($id);
        if (empty($products)) {
            return redirect(route('products.index'));
        }
        $products = $this->productsRepository->update($request->all(), $id);
        return redirect(route('products.index'));
    }

    public function destroy($id): object
    {
        $products = $this->productsRepository->find($id);
        if (empty($products)) {
            return redirect(route('products.index'));
        }
        $this->productsRepository->delete($id);
        return redirect(route('products.index'));
    }

    public static function DDDW(): array
    {
        return [" "] + Products::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function print(): object
    {
        return view('printing.productsPrint')->with(['products' => Products::all()]);
    }
}



