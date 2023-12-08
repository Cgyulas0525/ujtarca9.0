@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

<div class="form-group col-sm-12">
    @include('flash::message')
</div>

<div class="form-group col-sm-12">
    <div class="row">
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="form-group col-sm-6">
                    {!! Form::label('name', 'Név:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                </div>
                <!-- Postcode Field -->
                <div class="form-group col-sm-2">
                    {!! Form::label('postcode', 'Ir.szám:') !!}
                    {!! Form::select('postcode', App\Classes\SettlementsClass::settlementsPostcodeDDDW(),
                        isset($location->postcode) ? App\Models\Settlements::where('postcode', $location->postcode)->first()->postcode : null,
                        ['class' => 'select2 form-control', 'id' => 'postcode']) !!}
                </div>
                <!-- Settlement Id Field -->
                <div class="form-group col-sm-4">
                    {!! Form::label('settlement_id', 'Település:') !!}
                    {!! Form::select('settlement_id', App\Classes\SettlementsClass::settlementsDDDW(),
                        isset($location->settlement_id) ? $location->settlement_id : null,
                        ['class' => 'select2 form-control', 'id' => 'settlement_id']) !!}
                </div>
            </div>
            <!-- Address Field -->
            <div class="form-group col-sm-12">
                {!! Form::label('address', 'Cím:') !!}
                {!! Form::text('address', isset($location->address) ?? null, ['class' => 'form-control', 'maxlength' => 100]) !!}
            </div>

            <!-- Description Field -->
            <div class="form-group col-sm-12">
                {!! Form::label('description', 'Megjegyzés:') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="form-group col-sm-12">
                @include('layouts.table', ['title' => 'Kiszállítási partnerek',
                                           'class' => 'table table-hover table-bordered partners-table w-100'])
            </div>
        </div>

   </div>
</div>

@section('scripts')

    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/sweetalert.js') }} " type="text/javascript"></script>

    @include('functions.settlement.settlementPostcode_js')

    <script type="text/javascript">

        var table;

        $(function () {
            ajaxSetup();
            RequiredBackgroundModify('.form-control')

            table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 300,
                scrollX: true,
                paging: false,
                order: [[0, 'asc']],
                ajax: "{{ route('locationPartnersIndex', ['location' => $location]) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('locationPartnersCreate', ['location' => $location->id]) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Név', data: 'name', name: 'name'},
                ],
                buttons: [],
            });

        });
    </script>
@endsection
