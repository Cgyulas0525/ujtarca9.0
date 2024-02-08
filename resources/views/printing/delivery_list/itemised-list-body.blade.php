<div class="row w-100">
    <div class="row text-center w-100">
        <p class="h2 text-center w-100">
            {{ $delivery->delivery_number }} {{ date('Y.m.d', strtotime($delivery->date)) }} kiszállítás megrendelései
        </p>
    </div>
    <!-- /.col -->
</div>

<div class="row">
    @foreach ($orders as $order)
        <div class="row text-center w-100">
            <p class="h2 text-center w-100">
                Megrendelő: {{ $order->partners->name }}
            </p>
        </div>
        @include('printing.delivery_list.itemised-list-body-table')
    @endforeach
</div>

<div class="row justify-content-center">
    <div class="col-xs-10">
        <p class="h6">Készült: {{ date('Y.m.d', strtotime('today')) }}</p>
    </div>
</div>

