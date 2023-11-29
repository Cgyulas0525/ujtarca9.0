<div class="modal fade" id="addPartnerModal" tabindex="-1" role="dialog" aria-labelledby="addPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPartnerModalLabel">Új cím hozzáadása</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPartnerForm">
                    <div class="form-group col-sm-12">
                        {!! Form::label('name', 'Név:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required']) !!}
                    </div>

                    <!-- Postcode Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('postcode', 'Ir.szám:') !!}
                        {!! Form::select('postcode', App\Classes\SettlementsClass::settlementsPostcodeDDDW(), null,
                            ['class' => 'select2 form-control', 'id' => 'postcode']) !!}
                    </div>

                    <!-- Settlement Id Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('settlement_id', 'Település:') !!}
                        {!! Form::select('settlement_id', App\Classes\SettlementsClass::settlementsDDDW(), null,
                            ['class' => 'select2 form-control', 'id' => 'settlement_id']) !!}
                    </div>

                    <!-- Address Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('address', 'Cím:') !!}
                        {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'maxlength' => 100]) !!}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kilép</button>
                <button type="button" class="btn btn-primary" id="addPartnerBtn">Ment</button>
            </div>
        </div>
    </div>
</div>

