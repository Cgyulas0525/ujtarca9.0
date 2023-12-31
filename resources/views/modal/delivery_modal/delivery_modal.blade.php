<div class="modal fade" id="addDeliveryModal" tabindex="-1" role="dialog" aria-labelledby="addDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDeliveryModalLabel">Új kiszállítás hozzáadás</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    @include('modal.delivery_modal.deliveryModalFields')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kilép</button>
                <button type="button" class="btn btn-primary" id="addDeliveryBtn">Ellenőrzés</button>
            </div>
        </div>
    </div>
</div>
