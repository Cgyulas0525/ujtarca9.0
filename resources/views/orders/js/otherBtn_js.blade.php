<script type="text/javascript">

    function otherBtnEvent(event) {
        if ($('#partners_id').val() != '0' && $('#delivery_id').val() != '0') {

            var orderTypeValue = $('#ordertype').val().split(' ')[0];
            console.log('OrderType original:', $('#ordertype').val());
            console.log('OrderType split:', orderTypeValue);

            $.ajax({
                type: "POST",
                url: event === 'store' ? "{{ url('ordersStore')}}" : "{{ url('ordersUpdate')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: event === 'store' ? null : $('#orderid').val(),
                    ordernumber: $('#ordernumber').val(),
                    orderdate: $('#orderdate').val(),
                    delivery_id: $('#delivery_id').val(),
                    partners_id: $('#partners_id').val(),
                    description: $('#description').val(),
                    ordertype: orderTypeValue,
                },
                success: function (response) {
                    console.log('Ok:', response);
                    var url = "{{ route('orders.index') }}";
                    window.location.href = url;
                },
                error: function (xhr, status, error) {
                    console.log('Error Status:', status);
                    console.log('Error:', error);
                    console.log('Response:', xhr.responseText);
                    console.log('Status Code:', xhr.status);

                    let errorMessage = 'Hiba történt!\n';
                    errorMessage += 'Status: ' + xhr.status + '\n';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage += 'Üzenet: ' + xhr.responseJSON.message;
                    } else {
                        errorMessage += 'Részletek: ' + xhr.responseText;
                    }

                    alert(errorMessage);
                }
            });
        } else {
            sw('A partner és a kiszállítás kötelező mező!');
            $('#partner_id').focus();
        }

    }
</script>
