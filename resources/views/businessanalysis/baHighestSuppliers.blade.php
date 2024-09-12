<div class="row">
    <div class="col-lg-12 text-center">
        <h2 class="description-header"> Az idén náluk vásároltunk a legtöbbet </h2>
    </div>
</div>
<div class="row">
    @foreach($bestSuppliers as $bestSupplier)
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="description-block border-right">
                <span class="description-text">{{ substr($bestSupplier->partner->name, 0, 30) }}</span>
                <h5 class="description-header"> {{ number_format( $bestSupplier->sumamount,0,",",".") }} Ft.</h5>
                <h5 class="description-header"> {{ number_format( $bestSupplier->invoiceCount,0,",",".") }} számla</h5>
                <a href="{!! route('partners.show', $bestSupplier->partner_id) !!}" class="small-box-footer text-yellow">Adatlap <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    @endforeach
</div>
