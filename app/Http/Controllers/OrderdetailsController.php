<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderdetailsRequest;
use App\Http\Requests\UpdateOrderdetailsRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Orderdetails;
use App\Models\Orders;
use App\Repositories\OrderdetailsRepository;
use Illuminate\Http\Request;
use Response;
use Auth;
use DataTables;

class OrderdetailsController extends AppBaseController
{
    public function __construct(OrderdetailsRepository $orderdetailsRepo)
    {
        $this->orderdetailsRepository = $orderdetailsRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('productName', function($data) { return $data->produts->name; })
            ->addColumn('quantityName', function($data) { return $data->quantities->name; })
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('orderdetails.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn . '<a href="' . route('beforeDestroys', ['Orderdetails', $row["id"], 'orderdetails']) . '"
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
                return $this->dwData(Orderdetails::with('products')->with('quantities')->get());
            }
            return view('orderdetails.index');
        }
    }

    public function orderDetailsIndex(Request $request, $id)
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                $data = Orderdetails::with('orders')->with('products')->with('quantities')->where('orders_id', $id)->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('productName', function($data) { return $data->products->name; })
                    ->addColumn('quantityName', function($data) { return $data->quantities->name; })
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('beforeDestroysWithParam', ['Orderdetails', $row->id, 'editDetails', $row->orders_id]) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('orders.edit-with-detail');
        }
    }

    public function create()
    {
        return view('orderdetails.create');
    }

    public function orderdetailsCreate($id)
    {
        $orders = Orders::find($id);
        return view('orderdetails.create')->with('orders', $orders);
    }

    public function store(CreateOrderdetailsRequest $request)
    {
        $input = $request->all();
        $orderdetails = $this->orderdetailsRepository->create($input);
        $orders = Orders::find($orderdetails->orders_id);
        return view('orderdetails.create')->with('orders', $orders);
    }

    public function show($id)
    {
        $orderdetails = $this->orderdetailsRepository->find($id);
        if (empty($orderdetails)) {
            return redirect(route('orderdetails.index'));
        }
        return view('orderdetails.show')->with('orderdetails', $orderdetails);
    }

    public function edit($id)
    {
        $orderdetails = $this->orderdetailsRepository->find($id);
        if (empty($orderdetails)) {
            return redirect(route('orderdetails.index'));
        }
        return view('orderdetails.edit')->with('orderdetails', $orderdetails);
    }

    public function update($id, UpdateOrderdetailsRequest $request)
    {
        $orderdetails = $this->orderdetailsRepository->find($id);
        if (empty($orderdetails)) {
            return redirect(route('orderdetails.index'));
        }
        $orderdetails = $this->orderdetailsRepository->update($request->all(), $id);
        return redirect(route('orderdetails.index'));
    }

    public function destroy($id)
    {
        $orderdetails = $this->orderdetailsRepository->find($id);
        if (empty($orderdetails)) {
            return redirect(route('orderdetails.index'));
        }
        $this->orderdetailsRepository->delete($id);
        return redirect(route('editDetails', ['id' => $orderdetails->orders->id]));
    }

    public static function DDDW(): array
    {
        return [" "] + orderdetails::orderBy('name')->pluck('name', 'id')->toArray();
    }

    public function orderDetailsUpdate(Request $request): mixed
    {
        $orderdetail = Orderdetails::find($request->get('id'));
        $orderdetail->value = $request->get('value');
        $orderdetail->updated_at = now();
        $orderdetail->save();

        return Response::json(Orderdetails::find($request->get('id')));

    }
}
