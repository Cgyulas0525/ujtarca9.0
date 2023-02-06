<div class="content">
    <div class="row w-100">
        <div class="row text-center w-100">
            <p class="h2 text-center w-100">
                Pékáru lista
            </p>
        </div>
        <!-- /.col -->
    </div>

    <div class="row w-100">
        <div class="col-xs-6 w-50">
            Vevő:
            <address>
                <strong>{{ $partner->name }}</strong><br>
                {{ $partner->fullAddress }}<br>
                Mobil: {{ $partner->phonenumber }}<br>
                Email: {{ $partner->email }}
            </address>
        </div>
        <!-- /.col -->
        <div class="col-xs-6 w-50">
            Szállító:
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
                    <th class="text-right">Egység ár</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <td>{{ $product->name }}</td>
                    <td class="text-right">{{ number_format($product->price,2,",",".") }} Ft.</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

   <!-- /.row -->

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Készült: {{ date('Y.m.d', strtotime('today')) }}</p>
        </div>
    </div>
<!-- /.col -->
</div>
