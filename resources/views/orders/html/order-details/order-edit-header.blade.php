<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <section class="content-header">
                    <h4>{{ $orders->ordernumber }} {{ $orders->orderdate->format('Y-m-d') }}
                        <a href="{{ route('orderPrint', ['id' => $orders->id]) }}" class="btn btn-success alapgomb printBtn" title="Nyomtatás"><i class="fas fa-print"></i></a>
                        <a href="{{ route('orderEmail', ['id' => $orders->id]) }}" class="btn btn-success alapgomb printBtn" title="Email"><i class="fas fa-envelope-open"></i></a>
                        <a href="{{ route('orderReplay', ['id' => $orders->id]) }}" class="btn btn-success alapgomb printBtn" title="Ismétlés"><i class="fas fa-copy"></i></a>
                    </h4>
                </section>
            </div>
        </div>
    </div>
</section>
