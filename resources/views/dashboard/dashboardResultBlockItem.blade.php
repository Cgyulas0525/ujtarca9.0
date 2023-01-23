<li class="nav-item">
    <a href="{!! route($route) !!}" class="nav-link-black">
        <div class="row">
            <div class="col-lg-3">
                {{ $title }}
            </div>
            <div class="col-lg-9">
                {{ Form::text('out', $value, ['class' => 'form-control  text-right', 'id' => isset($id) ? $id : "id", 'readonly' => 'true'])  }}
            </div>
        </div>
    </a>
</li>

@section('scripts')
    <script src="{{ asset('/public/js/currencyFormatDE.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();
            var SITEURL = "{{url('/')}}";


            function modifyValue(api, parameter, field) {
                let url = SITEURL + '/' + api;
                $.ajax({
                    type: "GET",
                    url: url,
                    data: { witch: parameter},
                    success: function (response) {
                        $(field).val(currencyFormatDE(parseInt(response)));
                    },
                    error: function (response) {
                        alert('nem ok');
                    }
                });
            }

            $('.yearBtn').click(function () {
                modifyValue('sumClosure', 'year', '#arbevetel');
                modifyValue('sumInvoice', 'year', '#koltseg');
                modifyValue('sumFinancialResult', 'year', '#egyenleg');
                modifyValue('sumCash', 'year', '#kp');
                modifyValue('sumCard', 'year', '#kartya');
                modifyValue('sumSZCard', 'year', '#szkartya');
                modifyValue('sumAverige', 'year', '#atlag');
            });

            $('.mountBtn').click(function () {
                modifyValue('sumClosure', 'mount', '#arbevetel');
                modifyValue('sumInvoice', 'mount', '#koltseg');
                modifyValue('sumFinancialResult', 'mount', '#egyenleg');
                modifyValue('sumCash', 'mount', '#kp');
                modifyValue('sumCard', 'mount', '#kartya');
                modifyValue('sumSZCard', 'mount', '#szkartya');
                modifyValue('sumAverige', 'mount', '#atlag');
            });

            $('.weekBtn').click(function () {
                modifyValue('sumClosure', 'week', '#arbevetel');
                modifyValue('sumInvoice', 'week', '#koltseg');
                modifyValue('sumFinancialResult', 'week', '#egyenleg');
                modifyValue('sumCash', 'week', '#kp');
                modifyValue('sumCard', 'week', '#kartya');
                modifyValue('sumSZCard', 'week', '#szkartya');
                modifyValue('sumAverige', 'week', '#atlag');
            });

        });


    </script>
@endsection

