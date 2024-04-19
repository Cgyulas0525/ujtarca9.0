<script type="text/javascript">
    function putSession(variable, value) {
        $.ajax({
            type: 'POST',
            url: '{{url('api/putSession')}}',
            data: { variable: variable, value: value },
            success: function(response) {
                console.log('Sikeresen elküldve a szervernek');
            }
        });
    }
</script>

