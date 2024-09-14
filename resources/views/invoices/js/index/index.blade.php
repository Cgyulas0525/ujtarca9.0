@section('scripts')
    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            var table = indexTable();
            filterBtnTopClick(table);
            referredBtnClick(table);
        });
    </script>
@endsection
