<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Auth;
use DataTables;

class FeatureProductController extends Controller
{
    public function dwData($data): mixed
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('media', function ($data) {
                return !Empty($data->getFirstMediaUrl($data->getTable() . $data->pivot->feature_id)) ? $data->getFirstMediaUrl($data->getTable() . $data->id) : 'img/noAviableImage.jpg';
            })
            ->addColumn('value', function ($data) {
                return ($data->pivot->value);
            })
            ->addColumn('productId', function ($data) {
                return ($data->pivot->products_id);
            })
            ->addColumn('featureId', function ($data) {
                return ($data->pivot->feature_id);
            })
            ->make(true);
    }

    public function index(Request $request, $product): object
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return $this->dwData(Products::find($product)->features()->get());
            }
            return view('products.index');
        }
        return view('products.index');
    }
    public function featureProductUpdate(Request $request): void
    {
        Products::find($request->productId)->features()->updateExistingPivot($request->featuretId, ['value' => $request->value]);
    }
}
