@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.datatables_css')
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h4>Zárás</h4>
                        <div class="form-group col-sm-6">
                            <div class="row">
                                <div class="mylabel col-sm-1">
                                    {!! Form::label('year', 'Év:') !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('year', \App\Http\Controllers\ClosuresController::closuresYearsDDDW(), null,
                                            ['class'=>'select2 form-control', 'id' => 'year']) !!}
                                </div>
                                <div class="col-sm-1">
                                    <a href="#" class="btn btn-success filterBtn">Szűrés</a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body"  >
                            <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
                        </div>
                    </div>
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('layouts.datatables_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[1, 'desc']],
                ajax: "{{ route('closuresIndex', ['ev' => date('Y')]) }}",
                paging: false,
                select: false,

                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('closures.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Kelt', data: 'closuredate', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'closuredate'},
                    {title: 'Kártya', data: 'card', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'card'},
                    {title: 'Szép kártya', data: 'szcard', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'szcard'},
                    {title: 'Napközben', data: 'dayduring', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'dayduring'},
                    {title: 'Összesen', data: 'closureValue', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'closureValue',},
               ]
            });

            $('.filterBtn').click(function () {
                let year = $('#year').val() != 0 ? $('#year').val() : -9999;
                let url = '{{ route('closuresIndex', [":ev"]) }}';
                url = url.replace(':ev', year);
                table.ajax.url(url).load();
            });


        });
    </script>
@endsection


