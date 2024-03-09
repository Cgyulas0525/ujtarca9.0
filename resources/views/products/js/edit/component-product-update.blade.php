<script type="text/javascript">
    function componentProductUpdate(Row, value, table) {
        var d = table.row(Row).data();
        if (d.value != value) {
            d.value = value;
            $.ajax({
                type: "POST",
                url: "{{url('api/componentProductUpdate')}}",
                data: {productId: d.productId, componentId: d.componentId, value: value},
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
