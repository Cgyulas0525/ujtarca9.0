<script type="text/javascript">

    function otherBtnEvent(event) {
        if ($('#date').val() != 0 && $('#location_id').val() != 0) {
            $.ajax({
                type: event === 'store' ? "GET" : "POST",
                url: event === 'store' ? "{{url('storeModal')}}" : "{{url('updateModal')}}",
                data: {
                    id: event === 'store' ? null : $('#id').val(),
                    delivery_number: $('#delivery_number').val(),
                    date: $('#date').val(),
                    location_id: $('#location_id').val(),
                    description: $('#description').val(),
                },
                success: function (response) {
                    console.log('Ok:', response);
                    var url = "{{ route('deliveries.index') }}";
                    window.location.href = url;
                },
                error: function (response) {
                    console.log('Error:', response);
                    alert('nem ok');
                }
            });
        } else {
            sw('A dátum és a cím kötelező mező!');
            $('#location_id').focus();
        }

    }
</script>
