@include('locations.locationFields')

@section('scripts')

    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/sweetalert.js') }} " type="text/javascript"></script>

    @include('functions.settlement.settlementPostcode_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            $('#taxnumber').inputmask();
            $('#bankaccount').inputmask();
            $('#phonenumber').inputmask();

            RequiredBackgroundModify('.form-control')

        });
    </script>
@endsection
