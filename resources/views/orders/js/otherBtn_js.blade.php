<script type="text/javascript">

    function otherBtnEvent(event) {
        if ($('#partner_id').val() != '0' && $('#delivery_id').val() != '0') {
            $.ajax({
                type: event === 'store' ? "GET" : "POST",
                url: event === 'store' ? "{{ url('ordersStore')}}" : "{{ url('ordersUpdate')}}",
                data: {
                    id: event === 'store' ? null : $('#orderid').val(),
                    ordernumber: $('#ordernumber').val(),
                    orderdate: $('#orderdate').val(),
                    delivery_id: $('#delivery_id').val(),
                    partners_id: $('#partners_id').val(),
                    description: $('#description').val(),
                    ordertype: $('#ordertype').val(),
                },
                success: function (response) {
                    console.log('Ok:', response);
                    var url = "{{ route('orders.index') }}";
                    window.location.href = url;
                },
                error: function (response) {
                    console.log('Error:', response);
                    alert('nem ok');
                }
            });
        } else {
            sw('A partner és a kiszállítás kötelező mező!');
            $('#partner_id').focus();
        }

    }
</script>
