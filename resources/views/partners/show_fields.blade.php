@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

<div class="row">

    @include('partners.datapage.financialTurnover', ['title' => 'Forgalom összesen',
                                                     'card' => 'card bg-primary',
                                                     'count' => number_format(App\Models\Invoices::PartnerYearInvoicesSumAmount($partners->id) ,0,",",".") ])
    @include('partners.datapage.financialTurnover', ['title' => 'Idei forgalom összesen',
                                                     'card' => 'card bg-success',
                                                     'count' => number_format(App\Models\Invoices::PartnerYearInvoicesSumAmount($partners->id, date('Y')),0,",",".") ])

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
                        <div class="col-sm-5">
                            {!! Form::select('year', SelectService::invoicesYearsSelect(),date('Y'),
                                    ['class'=>'select2 form-control', 'id' => 'year']) !!}
                        </div>
                        <div class="col-sm-2" id="gifDiv">
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
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="row">
                <div class="form-group col-sm-6">
                    <div class="row">
                        <div class="mylabel col-sm-3">
                            {!! Form::label('year', 'Időszak:') !!}
                        </div>
                        <div class="col-sm-5">
                            {!! Form::select('year', ToolsClass::monthsPeriodDDDW(), 2,
                                    ['class'=>'select2 form-control', 'id' => 'period']) !!}
                        </div>
                        <div class="col-sm-3" id="gifDiv1">
                            <img src={{ URL::asset('/public/img/loading.gif') }}
                                class="gifcenter" >
                        </div>
                    </div>
                </div>

            </div>
            <div class="box-body"  >
                <table class="table table-hover table-bordered weekstable w-100">
                    @include('partners.table')
                </table>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script src="{{ asset('/js/currencyFormatDE.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/sweetalert.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">

        var table;
        var weeksTable;
        var loading = true;

        $(function () {

            $('[data-widget="pushmenu"]').PushMenu('collapse');

            ajaxSetup();

            table = $('.invoicetable').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[1, 'desc'], [0, 'asc']],
                paging: false,
                searching: false,
                select: false,
                ajax: "{{ route('partnerFactSheet', ['partner' => $partners->id, 'year' => date('Y')]) }}",
                columns: [
                    {title: 'Számlaszám', data: 'invoicenumber', name: 'invoicenumber'},
                    {title: 'Kelt', data: 'dated', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'dated'},
                    {title: 'Teljesítés', data: 'performancedate', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'performancedate'},
                    {title: 'Fiz.hat', data: 'deadline', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'deadline'},
                    {title: 'Fizetési mód', data: 'paymentMethodName', name: 'paymentMethodName'},
                    {title: 'Összeg', data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'amount'},
                ],
                buttons: [],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(5, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(5).footer()).html(currencyFormatDE(total));
                },

            });

            weeksTable = $('.weekstable').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[0, 'desc']],
                paging: false,
                searching: false,
                select: false,
                ajax: "{{ route('partnerPeriodicAccounts', ['partner' => $partners->id, 'months' => 6]) }}",
                columns: [
                    {title: 'Számlaszám', data: 'invoicenumber', name: 'invoicenumber'},
                    {title: 'Kelt', data: 'dated', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'dated'},
                    {title: 'Teljesítés', data: 'performancedate', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'performancedate'},
                    {title: 'Fiz.hat', data: 'deadline', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'deadline'},
                    {title: 'Fizetési mód', data: 'paymentMethodName', name: 'paymentMethodName'},
                    {title: 'Összeg', data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'amount'},
                ],
                buttons: [],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(5, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(5).footer()).html(currencyFormatDE(total));
                },

            });

            $('#year').change(function() {

                $('#gifDiv').show();

                let url = '{{ route('partnerFactSheet', [":partner", ":year"]) }}';
                url = url.replace(':partner', <?php echo $partners->id; ?>).replace(':year', ($('#year').val() != 0) ? $('#year').val() : -9999)
                table.ajax.url(url).load();

                setTimeout(function() {
                    $('#gifDiv').hide();}, 4000);

            });


            function getMonths(period) {

                var months = 0;

                switch (parseInt(period)) {
                    case 0:
                        months = 1;
                        break;
                    case 1:
                        months = 3;
                        alert
                        break;
                    case 2:
                        months = 6;
                        break;
                    case 3:
                        months = 12;
                        break;
                }

                return months;
            }

            $('#period').change(function() {

                $('#gifDiv1').show();

                let url = '{{ route('partnerPeriodicAccounts', [":partner", ":months"]) }}';
                url = url.replace(':partner', <?php echo $partners->id; ?>).replace(':months', getMonths($('#period').val()))
                weeksTable.ajax.url(url).load();

                setTimeout(function() {
                    $('#gifDiv1').hide();}, 4000);

            });

            $('#gifDiv').hide();
            $('#gifDiv1').hide();
        });


    </script>
@endsection

