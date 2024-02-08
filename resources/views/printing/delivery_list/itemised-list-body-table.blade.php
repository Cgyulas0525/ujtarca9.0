<div class="col-xs-12 table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th class="w-50">Termék</th>
            <th class="text-right w-25">Mennyiség</th>
            <th class="text-right w-25">Ár</th>
        </tr>
        </thead>
        <tbody>
        @foreach (App\Models\Orderdetails::with('products')->where('orders_id', $order->id)->get() as $detail)
            <tr>
                <td>{{ $detail->products->name }}</td>
                <td class="text-right">{{ number_format($detail->value,0,",",".") }}</td>
                <td class="text-right">{{ number_format($detail->detailvalue ,0,",",".") }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row w-100">
        <div class="row text-center w-100">
            <p class="h2 text-center w-100">
                Összesen: {{ number_format(App\Models\Orderdetails::where('orders_id', $order->id)->get()->sum('detailvalue'),0,",",".") }} Ft.</p>
            </p>
        </div>
    </div>
</div>
