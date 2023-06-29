@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

<div class="row">

    @include('partners.datapage.financialTurnover', ['title' => 'Forgalom összesen',
                                                     'card' => 'card bg-primary',
                                                     'count' => number_format(App\Models\Invoices::PartnerYearInvoicesSumAmount($partners->id) ,0,",",".") ])

    @include('partners.datapage.financialTurnover', ['title' => 'Átlagos heti forgalom',
                                                     'card' => 'card bg-danger',
                                                     'count' => number_format((new App\Services\InvoiceService)->partnerInvicesPeriodAverage('W', null, null, $partners->id), 0, ",", ".") ])

    @include('partners.datapage.financialTurnover', ['title' => 'Idei forgalom összesen',
                                                     'card' => 'card bg-success',
                                                     'count' => number_format(App\Models\Invoices::PartnerYearInvoicesSumAmount($partners->id, date('Y')),0,",",".") ])

    @include('partners.datapage.financialTurnover', ['title' => 'Idei átlagos heti forgalom',
                                                     'card' => 'card bg-danger',
                                                     'count' => number_format((new App\Services\InvoiceService)->partnerInvicesPeriodAverage('W', date('Y-m-d', strtotime('first day of January')), Carbon\Carbon::now(), $partners->id), 0, ",", ".") ])

    <div class="mylabel col-sm-1">
        {!! Form::label('name', 'Név:') !!}
    </div>
    <div class="mylabel col-sm-2">
        <p>{{ $partners->name }}</p>
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('name', 'Cím:') !!}
    </div>
    <div class="mylabel col-sm-6">
        <p>{{ $partners->fulladdress }}</p>
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('name', 'Státusz:') !!}
    </div>
    <div class="mylabel col-sm-1">
        <p>{{ ($partners->active == 1) ? 'Aktív' : 'Nem aktív'  }}</p>
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('name', 'Adószám:') !!}
    </div>
    <div class="mylabel col-sm-2">
        <p>{{ $partners->taxtnumber }}</p>
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('name', 'Bankszámla:') !!}
    </div>
    <div class="mylabel col-sm-3">
        <p>{{ $partners->bankaccount }}</p>
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('name', 'Telefonszám:') !!}
    </div>
    <div class="mylabel col-sm-1">
        <p>{{ $partners->phonenumber }}</p>
    </div>
    <div class="mylabel col-sm-1">
        {!! Form::label('name', 'Email:') !!}
    </div>
    <div class="mylabel col-sm-2">
        <p>{{ $partners->email }}</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="row">
                <div class="form-group col-sm-6">
                    <div class="row">
                        <div class="mylabel col-sm-3">
                            {!! Form::label('year', 'Számlák:') !!}
                        </div>
                        <div class="mylabel col-sm-2">
                            {!! Form::label('year', 'Év:') !!}
                        </div>
                        <div class="col-sm-4">
                            {!! Form::select('year', \App\Http\Controllers\InvoicesController::invoicesYearsDDDW(),date('Y'),
                                    ['class'=>'select2 form-control', 'id' => 'year']) !!}
                        </div>
                        <div class="col-sm-3" id="gifDiv">
                            <img src={{ URL::asset('/public/img/loading.gif') }}
                                class="gifcenter" >
                        </div>
                    </div>
                </div>

            </div>
            <div class="box-body"  >
                <table class="table table-hover table-bordered invoicetable w-100">
                    @include('partners.table')
                </table>
            </div>
        </div>
    </div>
    @include('partners.datapage.periodTable', ['title' => 'Év',
                                               'table' => "table table-hover table-bordered yeartable w-100"])
    @include('partners.datapage.periodTable', ['title' => 'Hónap',
                                               'table' => "table table-hover table-bordered monthtable w-100"])
    @include('partners.datapage.periodTable', ['title' => 'Hét',
                                               'table' => "table table-hover table-bordered weektable w-100"])

    @include('partners.datapage.hcItem', ['title' => 'Év',
                                          'chartId' => 'year2'])

    @include('partners.datapage.hcItem', ['title' => 'Hónap',
                                          'chartId' => 'month2'])

    @include('partners.datapage.hcItem', ['title' => 'Hét',
                                          'chartId' => 'week2'])



</div>


@section('scripts')
    <script src="{{ asset('/public/js/currencyFormatDE.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/sweetalert.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>
    @include('functions.tableData_js');

    <script src="{{ asset('/public/js/highchart/highchartLine.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/highchart/categoryUpload.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/highchart/chartDataUpload.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/highchart/highchartsTheme.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/highchart/highchartPie3D.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/highchart/highchartLanguage.js') }} " type="text/javascript"></script>


    <script type="text/javascript">

        var table;
        var yearTable;
        var monthTable;
        var weekTable;
        var loading = true;

        $(function () {

            $('[data-widget="pushmenu"]').PushMenu('collapse');

            ajaxSetup();

            table = tableData('.invoicetable',
                [[1, 'desc'], [0, 'asc']],
                "{{ route('partnerFactSheet', ['partner' => $partners->id, 'year' => date('Y')]) }}",
                [
                    {title: 'Számlaszám', data: 'invoicenumber', name: 'invoicenumber'},
                    {title: 'Kelt', data: 'dated', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'dated'},
                    {title: 'Teljesítés', data: 'performancedate', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'performancedate'},
                    {title: 'Fiz.hat', data: 'deadline', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'deadline'},
                    {title: 'Fiz.mód', data: 'paymentMethodName', name: 'paymentMethodName'},
                    {title: 'Összeg', data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'amount'},
                ],
                5
            );

            yearTable = tableData('.yeartable',
                                    [[0, 'desc']],
                                    "{{ route('partnerInvoicesPeriod', ['witch' => 'Y',
                                          'begin' => App\Models\Invoices::first()->dated,
                                          'end' => \Carbon\Carbon::now(),
                                          'partner' => $partners->id]) }}",
                                    [
                                        {title: 'Periódus', data: 'period', name: 'period'},
                                        {title: 'Összeg', data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'amount'},
                                    ],
                                    1
                                );

            monthTable = tableData('.monthtable',
                                    [[0, 'desc']],
                                    "{{ route('partnerInvoicesPeriod', ['witch' => 'M',
                                          'begin' => date('Y-m-d', strtotime('today - 12 month')),
                                          'end' => \Carbon\Carbon::now(),
                                          'partner' => $partners->id]) }}",
                                    [
                                        {title: 'Periódus', data: 'period', name: 'period'},
                                        {title: 'Összeg', data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'amount'},
                                    ],
                                    1
                                );

            weekTable = tableData('.weektable',
                                    [[0, 'desc']],
                                    "{{ route('partnerInvoicesPeriod', ['witch' => 'W',
                                          'begin' => date('Y-m-d', strtotime('today - 12 month')),
                                          'end' => \Carbon\Carbon::now(),
                                          'partner' => $partners->id]) }}",
                                    [
                                        {title: 'Periódus', data: 'period', name: 'period'},
                                        {title: 'Összeg', data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'amount'},
                                    ],
                                    1
            );

            $('#year').change(function() {

                $('#gifDiv').show();

                let url = '{{ route('partnerFactSheet', [":partner", ":year"]) }}';
                url = url.replace(':partner', <?php echo $partners->id; ?>).replace(':year', ($('#year').val() != 0) ? $('#year').val() : -9999)
                table.ajax.url(url).load();

                setTimeout(function() {
                    $('#gifDiv').hide();}, 4000);

            });

            $('#gifDiv').hide();
            $('#gifDiv1').hide();

            hightchartsTheme();

            var chartyear = highchartLine( 'year2', 'line', 400, categoryUpload(<?php echo (new App\Services\InvoiceService)->partnerInvoicesPeriod('Y', App\Models\Invoices::first()->dated, \Carbon\Carbon::now(), $partners->id); ?>, 'period'),
                chartDataUpload(<?php echo (new App\Services\InvoiceService)->partnerInvoicesPeriod('Y', App\Models\Invoices::first()->dated, \Carbon\Carbon::now(), $partners->id); ?>, ['amount'], ['Forgalom']), 'Éves frogalom', 'éves bontás', 'forint');

            var chartmonth = highchartLine( 'month2', 'line', 400, categoryUpload(<?php echo (new App\Services\InvoiceService)->partnerInvoicesPeriod('M', date('Y-m-d', strtotime('today - 12 month')), \Carbon\Carbon::now(), $partners->id); ?>, 'period'),
                chartDataUpload(<?php echo (new App\Services\InvoiceService)->partnerInvoicesPeriod('M', date('Y-m-d', strtotime('today - 12 month')), \Carbon\Carbon::now(), $partners->id); ?>, ['amount'], ['Forgalom']), 'Havi frogalom', 'Havi bontás', 'forint');

            var chartweek = highchartLine( 'week2', 'line', 400, categoryUpload(<?php echo (new App\Services\InvoiceService)->partnerInvoicesPeriod('W', date('Y-m-d', strtotime('today - 6 month')), \Carbon\Carbon::now(), $partners->id); ?>, 'period'),
                chartDataUpload(<?php echo (new App\Services\InvoiceService)->partnerInvoicesPeriod('W', date('Y-m-d', strtotime('today - 6 month')), \Carbon\Carbon::now(), $partners->id); ?>, ['amount'], ['Forgalom']), 'Heti frogalom', 'Heti bontás', 'forint');

        });


    </script>
@endsection

