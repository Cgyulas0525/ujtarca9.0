<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Új kiszállítás hozzáadás</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @include('modal.product_modal.productModalFields')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kilép</button>
                <button type="button" class="btn btn-primary" id="addProductBtn">Ellenőrzés</button>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/currencyFormatDE.js') }} " type="text/javascript"></script>

    @include('functions.sweetalert_js')
    @include('functions.requiredField')
    @include('functions.ajax_js')

    @include('modal.product_modal.productModalScript')
    @include('modal.product_modal.js.add-product-btn-event')
@endsection
