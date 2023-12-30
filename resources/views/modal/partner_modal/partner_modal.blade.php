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
                <button type="button" class="btn btn-primary" id="addPartnerBtn">Ment</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    @include('functions.settlement.settlementPostcode_js')
    @include('functions.sweetalert_js')
    @include('functions.requiredField')

    @include('modal.partner_modal.partnerModalScript')

    @include('functions.partnerScripts.emailChange')
    @include('functions.partnerScripts.nameChange')
    @include('functions.partnerScripts.newPartnerByModal')

    @include('modal.delivery_modal.deliveryModalScript')

    @include('functions.deliveryScripts.dateChange')
    @include('functions.deliveryScripts.locationChange')
    @include('functions.deliveryScripts.dateLocationChange')
    @include('functions.deliveryScripts.newDeliveryByModal')


    <script type="text/javascript">

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        RequiredBackgroundModify('.form-control')

        // $('#addModalBtn').click(function() {
        //     addModalBtnEvent();
        // });
    </script>
@endsection
