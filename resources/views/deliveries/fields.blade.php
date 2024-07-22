@section('css')
    {{--    @include('layouts.datatables_css')--}}
    @include('app-scaffold.css.costumcss')
@endsection


<!-- Delivery Number Field -->
<div class="form-group col-sm-2">
    {!! Form::label('delivery_number', 'Sorszám:') !!}
    {!! Form::text('delivery_number', isset($delivery) ? $delivery->delivery_number : App\Services\DeliveryService::nextDeliveryNumber(),
        ['class' => 'form-control', 'readonly' => true, 'id' => 'delivery_number']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-2">
    {!! Form::label('date', 'Dátum:') !!}
    {!! Form::date('date', isset($delivery) ? $delivery->date : \Carbon\Carbon::now()->toDateString(),
        ['class' => 'form-control','id'=>'date', 'required' => true]) !!}
</div>

<!-- Location Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'Cím:') !!}
    {!! Form::select('location_id', App\Http\Controllers\LocationController::DDDW(), null,
        ['class' => 'select2 form-control', 'id' => 'location_id', 'required' => true]) !!}
</div>

@include('layouts.modalBtn', [ 'title' => 'Új cím'])

<div class="form-group col-sm-12">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
    {!! Form::hidden('id', isset($delivery) ? $delivery->id : null, ['class' => 'form-control', 'id' => 'id']) !!}
</div>

{{--<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="addModalLabel">Új cím hozzáadása</h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <form id="addForm">--}}
{{--                    @include('deliveries.modalFields')--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-danger" data-dismiss="modal">Kilép</button>--}}
{{--                <button type="button" class="btn btn-primary" id="addModalBtn">Ment</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

@include('layouts.modal', [
        'addModal' => 'addModal',
        'title' => 'Új cím hozzáadása',
        'fields' => 'deliveries.modalFields',
        'saveBtn' => 'addModalBtn',
    ])

@section('scripts')

    @include('functions.ajax_js')
    @include('functions.required_js')
    @include('functions.sweetalert_js')
    @include('functions.settlement.settlementPostcode_js')
    @include('deliveries.addModalBtn_js')
    @include('functions.dateFormat_js')
    @include('deliveries.otherBtn_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            RequiredBackgroundModify('.form-control')

            function isRecord() {
                if ($('#date').val() != 0 && $('#location_id').val() != 0) {
                    $.ajax({
                        type: "POST",
                        url: "{{url('api/getDeliveryByDateAndLocation')}}",
                        data: {
                            date: $('#date').val(),
                            location_id: $('#location_id').val(),
                            delivery_number: $('#delivery_number').val()
                        },
                        success: function (response) {
                            console.log(response);
                            if (response > 0) {
                                sw('Van már erre a dátumra és címre kiszállítás!');
                                $("#date").val(dateFormat(new Date()));
                                $("#location_id").val(null);
                            }
                        },
                        error: function (error) {
                            console.error('Hiba történt:', error);
                        }
                    });
                }
            }

            $('#addModalBtn').click(function () {
                addModalBtnEvent();
            });

            function dateControll() {
                var currentDate = dateFormat(new Date());
                if ($("#date").val() < currentDate) {
                    sw('A kiválasztott dátum nem lehet korábbi, mint a mai dátum.');
                    $('#date').val(currentDate);
                    return false;
                }
                return true;
            }

            $('#date').change(function () {
                if (dateControll()) {
                    isRecord();
                }
            });

            $('#location_id').change(function () {
                isRecord();
            });

            $('#otherBtn').click(function (e) {
                var id = $('#id').val();
                if (id == null || id === 0 || id.length === 0) {
                    otherBtnEvent('store');
                } else {
                    otherBtnEvent('modify');
                }
            });

        });
    </script>
@endsection

