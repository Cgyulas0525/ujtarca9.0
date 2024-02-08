@section('scripts')
@include('functions.ajax_js')
@include('partner_types.js.index.table-js')
<script type="text/javascript">
    $(function () {
        ajaxSetup();
        indexTable();
    });
</script>
@endsection


