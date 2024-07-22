@extends('app-scaffold.html.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h4>Időszaki napi átlag árbevétel</h4>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
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
    @include('functions.ajax_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[0, 'desc']],
                ajax: "{{ route('averageDailyTurnover') }}",
                paging: false,
                select: false,
                columns: [
                    {title: 'Hónap', data: 'yearweek', sClass: "text-center", width: '150px', name: 'yearweek'},
                    {
                        title: 'Bevétel',
                        data: 'dailysum',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'dailysum'
                    },
                    {
                        title: 'Kiadás',
                        data: 'amount',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'amount'
                    },
                    {
                        title: 'Egyenleg',
                        data: 'result',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'result'
                    },
                ]
            });

        });
    </script>
@endsection


