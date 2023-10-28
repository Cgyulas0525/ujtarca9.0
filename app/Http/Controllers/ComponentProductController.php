<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use App\Models\Products;

class ComponentProductController extends Controller
{
    public function dwData($data): mixed
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('value', function ($data) {
                return ($data->pivot->value);
            })
            ->addColumn('productId', function ($data) {
                return ($data->pivot->products_id);
            })
            ->addColumn('componentId', function ($data) {
                return ($data->pivot->component_id);
            })
            ->make(true);
    }

    public function index(Request $request, $product): object
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $product = Products::find($product);
                return $this->dwData($product->components()->get());
            }
            return view('products.index');
        }
        return view('products.index');
    }
    public function componentProductUpdate(Request $request): void
    {
        $product = Products::find($request->get('productId'));
        $product->components()->updateExistingPivot($request->get('componentId'), ['value' => $request->get('value')]);
    }

}
