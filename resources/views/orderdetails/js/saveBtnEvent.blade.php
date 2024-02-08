<script type="text/javascript">

    function saveBtnEvent() {
        $.ajax({
            type: "GET",
            url: "{{ url('orderdetailStore')}}",
            data: {
                orders_id: $('#orders_id').val(),
                products_id: $('#products_id').val(),
                quantities_id: $('#quantities_id').val(),
                value: $('#value').val(),
                detailvalue: 0,
            },
            success: function (response) {
                console.log('Ok:', response);
                {{--var url = "{{ route('orderdetails.create', ['orders' => $orders]) }}";--}}
                {{--window.location.href = url;--}}
            },
            error: function (response) {
                console.log('Error:', response);
                alert('nem ok');
            }
        });
    }
</script>
<?php
