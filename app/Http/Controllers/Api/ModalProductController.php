<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Response;

class ModalProductController extends Controller
{
    public function newProductByModal(Request $request)
    {
        $product = new Products();
        $product->name = $request->input('name');
        $product->quantities_id = $request->input('quantities_id');
        $product->price = $request->input('price');
        $product->supplierprice = $request->input('supplierprice');
        $product->active = 'aktív';
        $product->save();
        $products = Products::all();
        return Response::json(['message' => 'Termék hozzáadva', 'products' => $products, 'product' => $product]);
    }
}
