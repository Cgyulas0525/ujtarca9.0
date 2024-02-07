@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Quantities Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantities_id', 'Mennyiségi egység:') !!}
    {!! Form::select('quantities_id', \App\Http\Controllers\QuantitiesController::DDDW(), null,
                ['class'=>'select2 form-control', 'id' => 'quantities_id', 'required' => true]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Eladási ár:') !!}
    {!! Form::number('price', isset($products) ? $products->price : 0, ['class' => 'form-control  text-right', 'id' => 'price']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('supplierprice', 'Beszerzési ár:') !!}
    {!! Form::number('supplierprice', isset($products) ? $products->supplierprice : 0, ['class' => 'form-control  text-right', 'id' => 'supplierprice']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control','maxlength' => 500, 'rows' => 4]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::hidden('active', 'Aktív:') !!}
    {!! Form::hidden('active', isset($products) ? $products->active->value : 'aktív', ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    @include('layouts.table', ['title' => 'Összetevők',
                               'class' => 'table table-hover table-bordered partners-table w-100'])
</div>

<div class="form-group col-sm-6">
    @include('layouts.table', ['title' => 'Jellemzők',
                               'class' => 'table table-hover table-bordered f_table w-100'])
</div>


@section('scripts')
    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/sweetalert.js') }} " type="text/javascript"></script>
    @include('functions.productScript.priceControll')

    <script type="text/javascript">
        var table;
        var ftable;

        $(function () {

            ajaxSetup();

            $('#price').change(function () {
                priceControll();
            });

            $('#supplierprice').change(function () {
                priceControll();
            });

            table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 300,
                scrollX: true,
                paging: false,
                order: [[0, 'asc']],
                ajax: "{{ route('componentProductIndex', ['product' => $products]) }}",
                columns: [
                    {title: 'Név', data: 'name', name: 'name'},
                    {title: 'Mennyiség', data: 'value', name: 'value', id: 'value'},
                    {title: 'componentId', data: 'componentId', name: 'componentId', id: 'componentId'},
                    {title: 'productId', data: 'productId', name: 'productId', id: 'productId'},
                ],
                columnDefs: [
                    {
                        targets: [1],
                        sClass: 'text-right',
                        width: '150px',
                        render: function (data, type, full, meta) {
                            return '<input class="form-control text-right" type="number" value="' + data + '" onfocusout="componentProductUpdate(' + meta["row"] + ', this.value)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" style="width:250px;height:20px;font-size: 15px;"/>';
                        },
                    },
                    {
                        targets: [2, 3],
                        visible: false
                    },
                ],
                buttons: [],
            });

            ftable = $('.f_table').DataTable({
                serverSide: true,
                scrollY: 300,
                scrollX: true,
                paging: false,
                order: [[0, 'asc']],
                ajax: "{{ route('featureProductIndex', ['product' => $products]) }}",
                columns: [
                    {title: 'Név', data: 'name', name: 'name'},
                    {
                        title: 'Ikon', data: "media", sClass: "text-center", "render": function (data) {
                            return '<img src="' + data + '" style="height:20px;width:20px;object-fit:cover;"/>';
                        }
                    },
                    {title: 'Kiválasztva', data: 'value', name: 'value', id: 'value'},
                    {title: 'featureId', data: 'featureId', name: 'featureId', id: 'featureId'},
                    {title: 'productId', data: 'productId', name: 'productId', id: 'productId'},
                ],
                columnDefs: [
                    {
                        targets: [2],
                        sClass: 'text-right',
                        width: '150px',
                        render: function (data, type, full, meta) {
                            var isChecked = data === 1 ? 'checked' : '';
                            return '<input class="form-control text-right" type="checkbox" value="' + data + '" onchange="featureProductUpdate(' + meta["row"] + ', this.value)" style="height:20px;font-size: 15px;" ' + isChecked + ' />';
                        },
                    },
                    {
                        targets: [3, 4],
                        visible: false
                    },
                ],
                buttons: [],
            });

        });

        function componentProductUpdate(Row, value) {
            var d = table.row(Row).data();
            if (d.value != value) {
                d.value = value;
                $.ajax({
                    type: "POST",
                    url: "{{url('api/componentProductUpdate')}}",
                    data: {productId: d.productId, componentId: d.componentId, value: value},
                    success: function (response) {
                        table.cell(Row, 1).data(d.value).draw();
                    },
                    error: function (response) {
                        // console.log('Error:', response);
                        alert('nem ok');
                    }
                });
                // table.draw();
                table.row(Row).invalidate();
            }
        }

        function featureProductUpdate(Row, value) {
            var d = ftable.row(Row).data();
            d.value = d.value == 1 ? 0 : 1;
            if (d.value != value) {
                $.ajax({
                    type: "POST",
                    url: "{{url('api/featureProductUpdate')}}",
                    data: {productId: d.productId, featuretId: d.featureId, value: d.value},
                    success: function (response) {
                        table.cell(Row, 1).data(d.value).draw();
                    },
                    error: function (response) {
                        // console.log('Error:', response);
                        alert('nem ok');
                    }
                });
                // table.draw();
                table.row(Row).invalidate();
            }
        }
    </script>
@endsection
