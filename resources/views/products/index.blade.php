@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
{{--    @include('layouts.datatables_css')--}}
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <div class="form-group col-sm-12">
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>Termékek
                                        <a href="{{ route('productsPrint') }}" class="btn btn-success alapgomb printBtn" title="Nyomtatás"><i class="fas fa-print"></i></a>
                                        <a href="{{ route('pdfEmail') }}" class="btn btn-success alapgomb printBtn" title="Email"><i class="fas fa-envelope-open"></i></a>
                                    </h4>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('active', ActiveEnum::Options(), (empty($_COOKIE['productsActive']) ? 'ACTIVE' : $_COOKIE['productsActive']),
                                            ['class'=>'select2 form-control', 'id' => 'active']) !!}
                                </div>
                            </div>
                        </div>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <table class="table table-hover table-bordered partners-table w-100"></table>
                        <div class="box-body"  >
                        </div>
                    </div>
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>
    @include('functions.cookiesFunctions_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 550,
                scrollX: true,
                paging: false,
                order: [[1, 'asc']],
                ajax: "{{ route('productsIndex', [empty($_COOKIE['productsActive']) ? 'aktív' : (($_COOKIE['productsActive'] == 'ACTIVE') ? 'aktív' : 'inaktív')]) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('products.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Név', data: 'name', name: 'name'},
                    {title: 'Mennyiségi egység', data: 'quantityName', sClass: "text-center", name: 'quantityName'},
                    {title: 'Ár', data: 'price', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'price'},
                    {title: 'Besz.Ár', data: 'supplierprice', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'supplierprice'},
                    {title: 'Státusz', data: 'active', sClass: "text-center", width:'100px', name: 'active'},
                ],
                buttons: [],
                fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    if (aData.active == 'inaktív') {
                        $('td', nRow).css('background-color', 'lightgray');
                    }
                    if (aData.partnertypes_id == 5) {
                        $('td', nRow).css('background-color', 'yellow');
                    }
                }
            });

            $('#active').change(function () {
                let url = '{{ route('productsIndex', [":active"]) }}';
                createCookie('productsActive', $('#active').val(), '30');
                url = url.replace(':active', ($('#active').val() == 'INACTIVE') ? 'inaktív' : 'aktív');
                table.ajax.url(url).load();
            })
        });
    </script>
@endsection


