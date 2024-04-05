@section('scripts')
    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            var table = setTable();
            filterBtnTopClick(table);
            referredBtnClick(table);
        });
    </script>
@endsection
