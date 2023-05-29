@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

<div class="row">
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
    <div class="col-lg-8 col-md-8 col-xs-12">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="row">
                <div class="form-group col-sm-6">
                    <div class="row">
                        <div class="mylabel col-sm-2">
                            {!! Form::label('year', 'Számlák:') !!}
                        </div>
                        <div class="mylabel col-sm-2">
                            {!! Form::label('year', 'Év:') !!}
                        </div>
                        <div class="col-sm-5">
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
    <div class="col-lg-4 col-md-4 col-xs-12">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="card bg-primary">
                    <div class="card-header">
                        <h4 class="card-title text-bold">Forgalom összesen:</h4>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body text-right">
                        <h4>{{ number_format(App\Models\Invoices::PartnerYearInvoicesSumAmount($partners->id) ,0,",",".") }} forint</h4>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card bg-success">
                    <div class="card-header">
                        <h4 class="card-title text-bold">Idei forgalom összesen:</h4>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body text-right">
                        <h4>{{ number_format(App\Models\Invoices::PartnerYearInvoicesSumAmount($partners->id, date('Y')),0,",",".") }} forint</h4>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script src="{{ asset('/public/js/currencyFormatDE.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/sweetalert.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">

        var table;
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

            $('#year').change(function() {

                $('#gifDiv').show();

                let url = '{{ route('partnerFactSheet', [":partner", ":year"]) }}';
                url = url.replace(':partner', <?php echo $partners->id; ?>).replace(':year', ($('#year').val() != 0) ? $('#year').val() : -9999)
                table.ajax.url(url).load();

                setTimeout(function() {
                    $('#gifDiv').hide();}, 4000);

            });

            $('#gifDiv').hide();
        });


    </script>
@endsection

