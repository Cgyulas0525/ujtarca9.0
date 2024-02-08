<div class="row w-100">
    <div class="row text-center w-100">
        <p class="h2 text-center w-100">
            {{ $products->first()->delivery_number }} {{ date('Y.m.d', strtotime($products->first()->date)) }} kiszállítás termék összesítő
        </p>
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>Termék</th>
                <th class="text-right">Mennyiség</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <td>{{ $product->product }}</td>
                <td class="text-right">{{ number_format($product->sum,0,",",".") }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <p class="h6">Készült: {{ date('Y.m.d', strtotime('today')) }}</p>
    </div>
</div>

