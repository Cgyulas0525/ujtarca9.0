<div class="row">
    <div class="col-lg-12 text-center">
        <h2 class="description-header"> Az idén náluk vásároltunk a legtöbbet </h2>
    </div>
</div>
<div class="row">
    @foreach(( new App\Services\InvoiceService)->bestSupplier(date('Y'), 6) as $data)
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="description-block border-right">
                <span class="description-text">{{ substr($data->partner->name, 0, 30) }}</span>
                <h5 class="description-header"> {{ number_format( $data->sumamount,0,",",".") }} Ft.</h5>
                <h5 class="description-header"> {{ number_format( $data->invoiceCount,0,",",".") }} számla</h5>
                <a href="{!! route('partners.show', $data->partner_id) !!}" class="small-box-footer text-yellow">Adatlap <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endforeach
</div>
