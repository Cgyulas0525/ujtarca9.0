<div class="row w-100">
    <div class="row text-center w-100">
        <p class="h2 text-center w-100">
            {{ $offer->offernumber }} {{ date('Y.m.d', strtotime($offer->offerdate)) }} megrendelés
        </p>
    </div>
    <!-- /.col -->
</div>

<div class="row w-100">
    <div class="col-xs-6 w-50">
        Szállító:
        <address>
            <strong>{{ $partner->name }}</strong><br>
            {{ $partner->fullAddress }}<br>
            Mobil: {{ $partner->phonenumber }}<br>
            Email: {{ $partner->email }}
        </address>
    </div>
    <!-- /.col -->
    <div class="col-xs-6 w-50">
        Megrendelő:
        <address>
            <strong>{{ $owner->name }}</strong><br>
            {{ $owner->fullAddress }}<br>
            Telefon: {{ $owner->phonenumber }}<br>
            Email: {{ $owner->email }}
        </address>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<!-- info row -->
<!-- Table row -->
<div class="row">
    <div class="col-xs-12 table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>Termék</th>
                <th class="text-right">Mennyiség</th>
                <th class="text-right">Me.</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($details as $detail)
                <td>{{ $detail->products->name }}</td>
                <td class="text-right">{{ number_format($detail->value,0,",",".") }}</td>
                <td class="text-center">{{ $detail->quantities->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <p class="h4">Összesen: {{ number_format(OfferClass::sumOfferSupplierPrice($offer->id),0,",",".") }} Ft.</p>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <p class="h6">Készült: {{ date('Y.m.d', strtotime('today')) }}</p>
    </div>
</div>
