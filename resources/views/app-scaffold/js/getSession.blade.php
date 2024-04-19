<script type="text/javascript">
    function getSession(variable) {
        let value = null;
        $.ajax({
            type: 'POST',
            url: '{{url('api/getSession')}}',
            data: { variable: variable },
            success: function(response) {
                value = response;
            }
        });
        return value;
    }
</script>

