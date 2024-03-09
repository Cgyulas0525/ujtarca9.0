<script type="text/javascript">
    function featureProductUpdate(Row, value, table) {
        var d = table.row(Row).data();
        d.value = d.value == 1 ? 0 : 1;
        if (d.value != value) {
            $.ajax({
                type: "POST",
                url: "{{url('api/featureProductUpdate')}}",
                data: {productId: d.productId, featuretId: d.featureId, value: d.value},
                success: function (response) {
                    table.cell(Row, 1).data(d.value).draw();
                },
                error: function (response) {
                    alert('nem ok');
                }
            });
            table.row(Row).invalidate();
        }
    }
</script>
