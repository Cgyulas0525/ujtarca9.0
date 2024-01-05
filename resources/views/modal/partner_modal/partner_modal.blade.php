<div class="modal fade" id="addPartnerModal" tabindex="-1" role="dialog" aria-labelledby="addPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPartnerModalLabel">Új partner hozzáadás</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @include('modal.partner_modal.partnerModalFields')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kilép</button>
                <button type="button" class="btn btn-primary" id="addPartnerBtn">Ellenőrzés</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    @include('functions.settlement.settlementPostcode_js')
    @include('functions.sweetalert_js')
    @include('functions.requiredField')
    @include('functions.dateFormat_js')

    @include('modal.partner_modal.partnerModalScript')

    @include('functions.partnerScripts.emailChange')
    @include('functions.partnerScripts.nameChange')
    @include('functions.partnerScripts.newPartnerByModal')

    @include('modal.delivery_modal.deliveryModalScript')

    @include('functions.deliveryScripts.dateChange')
    @include('functions.deliveryScripts.locationChange')
    @include('functions.deliveryScripts.dateLocationChange')
    @include('functions.deliveryScripts.newDeliveryByModal')

    @include('modal.location_modal.locationModalScript')
    @include('functions.locationScript.postcodeChange')
    @include('functions.locationScript.settlementChange')
    @include('functions.locationScript.locationName')
    @include('functions.locationScript.newLocationByModal')

    @include('orders.js.otherBtn_js')

    <script type="text/javascript">

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        RequiredBackgroundModify('.form-control')

        $('#otherBtn').click(function (e) {
            var id = $('#id').val();
            if (id == null || id === 0 || id.length === 0) {
                otherBtnEvent('store');
            } else {
                otherBtnEvent('modify');
            }
        });

        $('#orderdate').change(function () {
            var currentDate = dateFormat(new Date());
            if ($("#orderdate").val() < currentDate) {
                sw('A kiválasztott dátum nem lehet korábbi, mint a mai dátum.');
                $('#orderdate').val(currentDate);
                $('#orderdate').focus();
            }
        });
    </script>
@endsection
