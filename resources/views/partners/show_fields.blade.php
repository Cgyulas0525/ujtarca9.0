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

    @include('partners.datapage.showData')

</div>

<div class="row">

    @include('partners.datapage.showTable')

</div>
<div class="row">

    @include('partners.datapage.periodTable', ['title' => 'Év',
                                               'table' => "table table-hover table-bordered yeartable w-100",
                                               'chartId' => 'year2'])

{{--    @include('partners.datapage.hcItem', ['title' => 'Év',--}}
{{--                                          'chartId' => 'year2'])--}}

</div>
<div class="row">

    @include('partners.datapage.periodTable', ['title' => 'Hónap',
                                               'table' => "table table-hover table-bordered monthtable w-100",
                                               'chartId' => 'month2'])

{{--    @include('partners.datapage.hcItem', ['title' => 'Hónap',--}}
{{--                                          'chartId' => 'month2'])--}}

</div>
<div class="row">

    @include('partners.datapage.periodTable', ['title' => 'Hét',
                                               'table' => "table table-hover table-bordered weektable w-100",
                                               'chartId' => 'week2'])

{{--    @include('partners.datapage.hcItem', ['title' => 'Hét',--}}
{{--                                          'chartId' => 'week2'])--}}

</div>



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

            // $('[data-widget="pushmenu"]').PushMenu('collapse');

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

