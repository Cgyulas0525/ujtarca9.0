<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Új termék hozzáadás</h5>
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

@section('scripts')
    @include('functions.required_js')
    @include('functions.currencyFormatDE')

    @include('functions.sweetalert_js')
    @include('functions.requiredField')
    @include('functions.ajax_js')

    @include('modal.product_modal.productModalScript')

    @include('functions.productScript.newProductByModal')
    @include('modal.product_modal.add-product-btn-event')

    <script type="text/javascript">

        ajaxSetup();
        RequiredBackgroundModify('.form-control')

        $('#otherBtn').click(function (e) {
            var id = $('#id').val();
            if (id == null || id === 0 || id.length === 0) {
                otherBtnEvent('store');
            } else {
                otherBtnEvent('modify');
            }
        });

    </script>
@endsection

